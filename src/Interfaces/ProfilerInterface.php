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
 * Profiler Interface.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
interface ProfilerInterface extends ProviderInterface
{
    /**
     * constructor.
     *
     * @param ProviderInterface $provider
     * @param HandlerInterface  $handler
     * @param array             $options
     */
    public function __construct( ProviderInterface $provider, HandlerInterface $handler, array $options = [ ] );

    /**
     * Save Run.
     *
     * @param array $options
     *
     * @return bool
     *
     * @throws HandlerException if saving fails.
     */
    public function save( array $options = [ ] ): bool;

    /**
     * Set Urls To Normalize.
     *
     * @param array $list regex => string|callable,
     *
     * @return ProviderInterface
     */
    public function setNormalizeUrls( array $list = [ ] ): ProfilerInterface;

    /**
     * Ignore Functions/classes.
     *
     * @param array $functions
     *
     * @return ProviderInterface
     */
    public function setIgnoreFunctions( array $functions = [ ] ): ProfilerInterface;

    /**
     * Ignore Variables from Url.
     *
     * @param array $vars
     *
     * @return ProviderInterface
     */
    public function setIgnoreVariables( array $vars = [ ] ): ProfilerInterface;
}