<?php
/**
 * This file is part of {@see arabcoders\profiler} package.
 *
 * (c) 2014-2016 Abdul.Mohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\profiler\Handlers;

use arabcoders\profiler\
{
    Interfaces\HandlerInterface,
    Exceptions\HandlerException
};

/**
 * Handler: String.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class StringHandler implements HandlerInterface
{
    protected $data = [ ];

    /**
     * FileHandler constructor.
     *
     * @param array $options
     */
    public function __construct( array $options = [ ] )
    {
    }

    /**
     * Save Profiler Data.
     *
     * @param array $data
     * @param array $options
     *
     * @return bool
     * @throws HandlerException if saving failed.
     */
    public function save( array $data, array $options = [ ] ): bool
    {
        $this->data = $data;

        return true;
    }
}