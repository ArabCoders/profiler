<?php

class SamplerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var arabcoders\profiler\Providers\Blackhole
     */
    protected $provider;

    /**
     * @var \arabcoders\profiler\Handlers\StringHandler
     */
    protected $handler;

    /**
     * @var \arabcoders\profiler\Profiler
     */
    protected $profiler;

    /**
     * @var \arabcoders\profiler\Sampler
     */
    protected $sampler;

    public function setUp()
    {
        $this->provider = new arabcoders\profiler\Providers\Blackhole();
        $this->handler  = new \arabcoders\profiler\Handlers\StringHandler();
        $this->profiler = new \arabcoders\profiler\Profiler( $this->provider, $this->handler );
        $this->sampler  = new \arabcoders\profiler\Sampler( $this->profiler, PHP_INT_MIN, PHP_INT_MAX );
    }

    public function testShouldRunOnZeroByZeroTrue()
    {
        $this->assertTrue( $this->sampler->shouldRun( 1, 1 ) );
    }

    /**
     * Shoudl return false
     */
    public function testShouldRunOnInfbyInfFalse()
    {
        $this->assertFalse( $this->sampler->shouldRun( 0, PHP_INT_MAX ) );
    }
}