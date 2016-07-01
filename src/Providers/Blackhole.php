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
    Interfaces\ProviderInterface
};

/**
 * Provider: Blackhole.
 *
 * Does not return any data.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class Blackhole implements ProviderInterface
{
    protected $data = [ ];

    /**
     * UProfiler constructor.
     *
     * @param array $options
     */
    public function __construct( array $options = [ ] )
    {
    }

    public function enable( $flags = 0, array $options = [ ] ): ProviderInterface
    {
        return $this;
    }

    public function disable( array $options = [ ] ): ProviderInterface
    {
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }
}