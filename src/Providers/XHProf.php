<?php
/**
 * This file is part of {@see arabcoders\profiler} package.
 *
 * (c) 2014-2016 Abdul.Mohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\profiler\Providers;

use arabcoders\profiler\
{
    Interfaces\ProviderInterface,
    Exceptions\ProviderException
};

/**
 * Provider: XhProf
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class XHProf implements ProviderInterface
{
    /**
     * @var array
     */
    protected $data = [ ];

    /**
     * Constructor.
     *
     * @param array $options
     */
    public function __construct( array $options = [ ] )
    {
        if ( !extension_loaded( 'xhprof' ) )
        {
            throw new ProviderException( 'XHProf extension is not loaded.' );
        }
    }

    public function enable( $flags = 0, array $options = [ ] ): ProviderInterface
    {
        $flags = ( empty( $flags ) ) ? XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_NO_BUILTINS : $flags;

        xhprof_enable( $flags, $options );

        return $this;
    }

    public function disable( array $options = [ ] ): ProviderInterface
    {
        $this->data = xhprof_disable();

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }
}