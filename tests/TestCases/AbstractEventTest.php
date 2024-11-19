<?php

namespace Silencenjoyer\Observer\Tests\TestCases;

use Silencenjoyer\Observer\Events\AbstractEvent;
use Silencenjoyer\Observer\Events\EventInterface;

/**
 * Class BaseEventTest
 *
 * @package Silencenjoyer\Observer\Tests
 */
class AbstractEventTest extends BaseEvent
{
    function createInstance(): EventInterface
    {
        return $this->getMockBuilder(AbstractEvent::class)
            ->onlyMethods([])
            ->getMock()
        ;
    }

    /**
     * {@inheritDoc}
     * @return array[]
     */
    function descriptionProvider(): array
    {
        return [
            ['CamelCase', 'Camel Case'],
            ['snake_case', 'Snake Case'],
        ];
    }

    /**
     * @dataProvider descriptionProvider()
     * @covers
     * @param string $input
     * @param string $expected
     * @return void
     */
    public function testGetDescription(string $input, string $expected): void {
        $mock = $this->getMockBuilder(AbstractEvent::class)
            ->setMockClassName($input)
            ->onlyMethods([])
            ->getMock()
        ;
        $this->assertEquals($expected, $mock->getDescription());
    }
}
