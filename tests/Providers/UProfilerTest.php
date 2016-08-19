<?php

/**
 * Test Tideways Provider.
 *
 * @requires extension uprofiler
 */
class UProfilerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var arabcoders\profiler\Providers\UProfiler
     */
    protected $provider;

    public function setUp()
    {
        $this->provider = new arabcoders\profiler\Providers\UProfiler();
    }

    public function testEnable()
    {
        $this->provider->enable();

        $this->assertInstanceOf( \arabcoders\Profiler\Interfaces\ProviderInterface::class, $this->provider );
    }

    public function testDsiable()
    {
        $this->provider->disable();

        $this->assertInstanceOf( \arabcoders\Profiler\Interfaces\ProviderInterface::class, $this->provider );
    }

    public function testGetData()
    {
        $this->assertInternalType( 'array', $this->provider->getData() );
    }
}