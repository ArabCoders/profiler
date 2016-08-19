<?php

use arabcoders\profiler\
{
    Interfaces\HandlerInterface,
    Exceptions\HandlerException
};

/**
 * Test File Handler.
 */
class FileTest extends \PHPUnit_Framework_TestCase
{
    const FILENAME = 'FileTest.json';

    /**
     * @var arabcoders\profiler\Handlers\FileHandler
     */
    protected $handler;

    public function setUp()
    {
        if ( !is_writable( sys_get_temp_dir() ) )
        {
            $this->markTestSkipped(
                sprintf( 'Skipping File Handler tests as we cant write to ( %s ).', sys_get_temp_dir() )
            );
        }

        $this->handler = new arabcoders\profiler\Handlers\FileHandler( sys_get_temp_dir() );
    }

    public function testExceptionOnUnreadableDir()
    {
        $this->setExpectedException( HandlerException::class );

        new arabcoders\profiler\Handlers\FileHandler( '://fff' );
    }

    public function testSave()
    {
        $this->assertTrue( $this->handler->save( [ 'foo' ] ) );
    }

    public function testSetName()
    {
        $this->handler->setName( 'foo.json' );

        $this->assertInstanceOf( HandlerInterface::class, $this->handler );
    }

    public function testGetName()
    {
        $this->handler->setName( 'foo.json' );

        $this->assertSame( 'foo.json', $this->handler->getName() );
    }

    public function __destruct()
    {
        if ( file_exists( self::FILENAME ) )
        {
            unlink( self::FILENAME );
        }
    }

}