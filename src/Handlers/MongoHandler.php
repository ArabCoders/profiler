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

use \MongoCollection;
use \arabcoders\profiler\Exceptions\HandlerException,
    \arabcoders\profiler\Interfaces\HandlerInterface;

/**
 * Handler: MongoDB
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class MongoHandler implements HandlerInterface
{
    /**
     * @var MongoCollection
     */
    protected $mongoCollection;

    /**
     * MongoHandler constructor.
     *
     * @param MongoCollection $mongo
     */
    public function __construct( MongoCollection $mongo )
    {
        $this->mongoCollection = $mongo;
    }

    /**
     * Save profile data.
     *
     * @param array $data
     * @param array $options
     *
     * @return bool
     * @throws HandlerException if saving failed.
     */
    public function save( array $data, array $options = [ ] )
    {
        try
        {
            $this->mongoCollection->insert( $data );
        }
        catch ( \MongoException $e )
        {
            throw new HandlerException( $e->getMessage(), $e->getCode(), $e->getPrevious() );
        }

        return true;
    }
}