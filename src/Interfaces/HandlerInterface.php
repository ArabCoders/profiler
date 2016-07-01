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

use arabcoders\profiler\
{
    Exceptions\HandlerException
};

/**
 * Handler Interface.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
interface HandlerInterface
{
    /**
     * Save Profiler Data.
     *
     * @param array $data
     * @param array $options
     *
     * @return bool
     * @throws HandlerException if saving failed.
     */
    public function save( array $data, array $options = [ ] ): bool;
}