<?php

namespace Silencenjoyer\Observer\Tests\TestCases;

use PHPUnit\Framework\TestCase;
use Silencenjoyer\Observer\Events\EventInterface;

/**
 * Class AbstractEventTest
 *
 * @package Silencenjoyer\Observer\Tests
 */
abstract class BaseEvent extends TestCase
{
    protected EventInterface $event;

    abstract function createInstance(): EventInterface;

    /**
     * A data provider for {@see testGetDescription()}.
     *
     * @return array
     */
    abstract function descriptionProvider(): array;

    /**
     * {@inheritDoc}
     * @return void
     */
    protected function setUp(): void
    {
        $this->event = $this->createInstance();
    }

    /**
     * @dataProvider descriptionProvider()
     * @covers
     * @param string $input
     * @param string $expected
     * @return void
     */
    public function testGetDescription(string $input, string $expected): void
    {
        $name = $expected;
        $this->assertEquals($name, $this->event->getDescription());
    }

    /**
     * @covers
     * @return void
     */
    public function testIsHandled(): void
    {
        $this->assertFalse($this->event->isHandled());
    }

    /**
     * @covers
     * @return void
     */
    public function testHandle(): void
    {
        $this->event->handle();
        $this->assertTrue($this->event->isHandled());
    }

    /**
     * @covers
     * @return void
     */
    public function testUnHandle(): void
    {
        $this->event->handle();
        $this->event->unHandle();
        $this->assertFalse($this->event->isHandled());
    }
}
