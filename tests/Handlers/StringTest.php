<?php

/**
 * Test String Handler
 */
class StringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var arabcoders\profiler\Handlers\StringHandler
     */
    protected $handler;

    public function setUp()
    {
        $this->handler = new arabcoders\profiler\Handlers\StringHandler();
    }

    public function testSave()
    {
        $this->assertTrue( $this->handler->save( [ ] ) );
    }
}