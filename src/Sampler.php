<?php
/**
 * This file is part of {@see arabcoders\profiler} package.
 *
 * (c) 2016 Abdul.Mohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\profiler;

use arabcoders\profiler\
{
    Interfaces\ProfilerInterface
};

/**
 * Sample Requests.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class Sampler
{
    const MIN = 0;

    const MAX = 10000;

    /**
     * Sample Requests.
     *
     * <code>
     *  $options = [
     *      // set random paremeters.
     *      'min'           => int,
     *      'max'           => int,
     *      // flags to pass to enable.
     *      'enableFlags'   => int,
     *      // options to pass to enable.
     *      'enableOptions' => []
     *  ];
     *
     * @param ProfilerInterface $profiler
     * @param int               $min
     * @param int               $max
     * @param array             $options
     */
    public function __construct( ProfilerInterface $profiler, int $min = self::MIN, int $max = self::MAX, array $options = [ ] )
    {
        $this->profiler = $profiler;

        if ( $this->shouldRun( $min, $max ) )
        {
            $eFlags   = ( array_key_exists( 'enableFlags', $options ) ) ? $options['enableFlags'] : null;
            $eOptions = ( array_key_exists( 'enableOptions', $options ) ) ? $options['enableOptions'] : [ ];

            $this->profiler->enable( $eFlags, $eOptions );

            register_shutdown_function( function () use ( $profiler )
            {
                $profiler->disable();
                $profiler->save();
            } );
        }
    }

    /**
     * given random number return true if match.
     *
     * @param int $min
     * @param int $max
     *
     * @return bool
     */
    public function shouldRun( int $min, int $max ): bool
    {
        return rand( $min, $max ) === rand( $min, $max );
    }
}