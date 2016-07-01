<?php
/**
 * This file is part of {@see arabcoders\profiler} package.
 *
 * (c) 2014-2016 Abdul.Mohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\profiler;

use arabcoders\profiler\
{
    Interfaces\HandlerInterface,
    Interfaces\ProviderInterface,
    Interfaces\ProfilerInterface
};

/**
 * Profile Request.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class Profiler implements ProfilerInterface
{
    /**
     * @var ProviderInterface
     */
    protected $provider;

    /**
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * @var array
     */
    protected $data = [ ];

    /**
     * @var array
     */
    protected $list = [ ];

    /**
     * @var array
     */
    protected $patRemoval = [
        '\?%key%\=(.+?)\&' => '?',
        '\&%key%\=(.+?)\&' => '&',
        '\?%key%\=(.+?)'   => '',
        '\&%key%\=(.+?)'   => '',
    ];

    /**
     * @var array
     */
    protected $ignoreVariables = [ ];

    /**
     * @var array
     */
    protected $ignoreFunctions = [ ];

    public function __construct( ProviderInterface $provider, HandlerInterface $handler, array $options = [ ] )
    {
        $this->handler  = $handler;
        $this->provider = $provider;
    }

    public function enable( $flags = 0, array $options = [ ] ): ProviderInterface
    {
        $options = array_merge_recursive( $options, $this->ignoreFunctions );

        $this->provider->enable( $flags, $options );

        return $this;
    }

    public function disable( array $options = [ ] ): ProviderInterface
    {
        $this->provider->disable( $options );

        $this->data['profile'] = $this->provider->getData();

        return $this;
    }

    public function getData(): array
    {
        if ( !empty( $this->data['meta'] ) )
        {
            return $this->data;
        }

        $uri  = array_key_exists( 'REQUEST_URI', $_SERVER ) ? $_SERVER['REQUEST_URI'] : null;
        $time = array_key_exists( 'REQUEST_TIME', $_SERVER ) ? $_SERVER['REQUEST_TIME'] : time();

        $rtf = explode( '.', $_SERVER['REQUEST_TIME_FLOAT'] );

        if ( empty( $uri ) && isset( $_SERVER['argv'] ) )
        {
            $cmd = basename( $_SERVER['argv'][0] );
            $uri = $cmd . ' ' . implode( ' ', array_slice( $_SERVER['argv'], 1 ) );
        }

        if ( !isset( $rtf[1] ) )
        {
            $rtf[1] = 0;
        }

        foreach ( $this->ignoreVariables as $_in => $varName )
        {
            foreach ( $this->patRemoval as $_repl => $_rep )
            {
                $_repl = str_replace( '%key%', $varName, $_repl );
                $uri   = preg_replace( '#' . $_repl . '#s', $_rep, $uri );
            }
        }

        $this->data['meta'] = [
            'url'              => $uri,
            'get'              => $_GET,
            'env'              => $_ENV,
            'SERVER'           => $_SERVER,
            'request_ts'       => [
                'sec'  => $time,
                'usec' => 0
            ],
            'request_ts_micro' => [
                'sec'  => $rtf[0],
                'usec' => $rtf[1]
            ],
            'simple_url'       => $this->simplifyUrl( $uri ),
            'request_date'     => ( new \DateTime() )->setTimestamp( $time )->format( 'Y-m-d' ),
        ];

        return $this->data;
    }

    public function save( array $options = [ ] ): bool
    {
        return $this->handler->save( $this->getData(), $options );
    }

    public function setNormalizeUrls( array $list = [ ] ): ProfilerInterface
    {
        $this->list = $list;

        return $this;
    }

    public function setIgnoreVariables( array $vars = [ ] ): ProfilerInterface
    {
        $this->ignoreVariables = $vars;

        return $this;
    }

    public function setIgnoreFunctions( array $functions = [ ] ): ProfilerInterface
    {
        $this->ignoreFunctions = $functions;

        return $this;
    }

    /**
     * Simplify urls.
     *
     * @param $url
     *
     * @return string
     */
    protected function simplifyUrl( $url ): string
    {
        foreach ( $this->list as $regex => $normalizedUrl )
        {
            if ( preg_match( $regex, $url, $matches ) )
            {
                $url = ( is_callable( $normalizedUrl ) ) ? $normalizedUrl( $matches, $url ) : $normalizedUrl;
            }
        }

        return $url;
    }
}