<?php

/**
 * Test Tideways Provider.
 */
class BlackholeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var arabcoders\profiler\Providers\Blackhole
     */
    protected $provider;

    public function setUp()
    {
        $this->provider = new arabcoders\profiler\Providers\Blackhole();
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

    public function testActualReturnData()
    {
        $this->assertSame( [ ], $this->provider->getData() );
    }
}