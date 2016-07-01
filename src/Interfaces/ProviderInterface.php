<?php
/**
 * This file is part of {@see arabcoders\profiler} package.
 *
 * (c) 2014-2016 Abdul.Mohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\profiler\Interfaces;

/**
 * Provider Interface.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
interface ProviderInterface
{
    /**
     * Enable Gathering Of data.
     *
     * @param int   $flags
     * @param array $options
     *
     * @return ProviderInterface
     */
    public function enable( $flags = 0, array $options = [ ] ): ProviderInterface;

    /**
     * Disable The Gathering of data.
     *
     * @param array $options
     *
     * @return ProviderInterface
     */
    public function disable( array $options = [ ] ): ProviderInterface;

    /**
     * Get Gathered Data.
     *
     * @return array
     */
    public function getData(): array;
}