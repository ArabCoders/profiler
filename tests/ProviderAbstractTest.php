<?php
use \arabcoders\profiler\
{
    Profiler,
    Providers\Blackhole,
    Handlers\StringHandler,
    Interfaces\ProfilerInterface,
    Interfaces\ProviderInterface
};

class ProviderAbstractTest extends \PHPUnit_Framework_TestCase
{
    const NormalizeUrls = [
        '/foo/si' => 'bar/'
    ];

    const IgnoreFunctionsArray = [
        'nl2br'
    ];

    const IgnoreVariablesArray = [
        'sid'
    ];
    /**
     * @var Blackhole
     */
    protected $provider;

    /**
     * @var StringHandler
     */
    protected $handler;

    /**
     * @var ProfilerInterface
     */
    protected $profiler;

    public function setUp()
    {
        $this->provider = new Blackhole();
        $this->handler  = new StringHandler();
        $this->profiler = new Profiler( $this->provider, $this->handler );
    }

    /**
     * @expectedException TypeError
     * @covers Profiler::__construct
     */
    public function testConstructorProvider()
    {
        new Profiler( 'foo', $this->handler );
    }

    /**
     * @expectedException TypeError
     * @covers Profiler::__construct
     */
    public function testConstructorHandler()
    {
        new Profiler( $this->provider, 'bar' );
    }

    /**
     * @covers Profiler::Save
     */
    public function testSave()
    {
        $this->assertTrue( $this->profiler->save( [ ] ) );
    }

    /**
     * @covers Profiler::enable
     */
    public function testEnable()
    {
        $this->assertInstanceOf( ProviderInterface::class, $this->provider->enable( 0 ) );
    }

    /**
     * @covers Profiler::disable
     */
    public function testDisable()
    {
        $this->assertInstanceOf( ProviderInterface::class, $this->provider->disable() );
    }

    /**
     * @covers Profiler::getData
     */
    public function testData()
    {
        $this->assertSame( 'array', gettype( $this->provider->getData() ) );
    }

    /**
     * @covers Profiler::setNormalizeUrls
     */
    public function testsetNormalizeUrls()
    {
        $this->profiler->setNormalizeUrls( self::NormalizeUrls );

        $this->assertInstanceOf( ProfilerInterface::class, $this->profiler );
    }

    /**
     * @covers Profiler::getNormalizeUrls
     */
    public function testgetNormalizeUrls()
    {
        $this->profiler->setNormalizeUrls( self::NormalizeUrls );
        $this->assertSame( self::NormalizeUrls, $this->profiler->getNormalizeUrls() );
    }

    /**
     * @covers Profiler::getNormalizeUrls
     */
    public function testgetNormalizeUrlsReturnAsArray()
    {
        $this->assertSame( 'array', gettype( $this->profiler->getNormalizeUrls() ) );
    }

    /**
     * @covers Profiler::setIgnoreFunctions
     */
    public function testsetIgnoreFunctions()
    {
        $this->profiler->setIgnoreFunctions( self::IgnoreFunctionsArray );

        $this->assertInstanceOf( ProfilerInterface::class, $this->profiler );
    }

    /**
     * @covers Profiler::getIgnoreFunctions
     */
    public function testgetIgnoreFunctions()
    {
        $this->profiler->setIgnoreFunctions( self::IgnoreFunctionsArray );
        $this->assertSame( self::IgnoreFunctionsArray, $this->profiler->getIgnoreFunctions() );
    }

    /**
     * @covers Profiler::getIgnoreFunctions
     */
    public function testsetIgnoreFunctionsReturnAsArray()
    {
        $this->assertSame( 'array', gettype( $this->profiler->getNormalizeUrls() ) );
    }

    /**
     * @covers Profiler::setIgnoreVariables
     */
    public function testsetIgnoreVariables()
    {
        $this->profiler->setIgnoreVariables( self::IgnoreFunctionsArray );

        $this->assertInstanceOf( ProfilerInterface::class, $this->profiler );
    }

    /**
     * @covers Profiler::getIgnoreVariables
     */
    public function testgetIgnoreVariables()
    {
        $this->profiler->setIgnoreVariables( self::IgnoreFunctionsArray );
        $this->assertSame( self::IgnoreFunctionsArray, $this->profiler->getIgnoreVariables() );
    }

    /**
     * @covers Profiler::getIgnoreVariables
     */
    public function testgetIgnoreVariablesReturnAsArray()
    {
        $this->assertSame( 'array', gettype( $this->profiler->getIgnoreVariables() ) );
    }

    /**
     * @covers Profiler::simplifyUrl
     */
    public function testSimplifyUrl()
    {
        $this->profiler->setNormalizeUrls( self::NormalizeUrls );

        $this->assertSame( array_values( self::NormalizeUrls )[0], $this->profiler->simplifyUrl( 'foo/' ) );
    }

}