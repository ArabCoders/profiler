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
 * Provider: UProfiler
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class UProfiler implements ProviderInterface
{
    protected $data = [ ];

    /**
     * UProfiler constructor.
     *
     * @param array $options
     */
    public function __construct( array $options = [ ] )
    {
        if ( !extension_loaded( 'uprofiler' ) )
        {
            throw new ProviderException( 'UProfiler extension is not loaded.' );
        }
    }

    public function enable( $flags = 0, array $options = [ ] ): ProviderInterface
    {
        $flags = ( empty( $flags ) ) ? UPROFILER_FLAGS_CPU | UPROFILER_FLAGS_MEMORY | UPROFILER_FLAGS_NO_BUILTINS : $flags;
        uprofiler_enable( $flags, $options );

        return $this;
    }

    public function disable( array $options = [ ] ): ProviderInterface
    {
        $this->data = uprofiler_disable();

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }
}