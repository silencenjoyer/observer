<?php

namespace Silencenjoyer\Observer\Tests\TestCases;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Silencenjoyer\Observer\EventDispatcherInterface;
use Silencenjoyer\Observer\Events\AbstractEvent;
use Silencenjoyer\Observer\Events\EventInterface;
use Silencenjoyer\Observer\EventSubscriberInterface;
use Silencenjoyer\Observer\Tests\EventSubscribers\TestEventSubscriber;

/**
 * Class EventDispatcherTest
 */
abstract class AbstractEventDispatcher extends TestCase
{
    protected EventDispatcherInterface $dispatcher;
    protected EventSubscriberInterface $subscriber;

    abstract function createInstance(): EventDispatcherInterface;

    /**
     * {@inheritDoc}
     * @return void
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->dispatcher = $this->createInstance();
        $this->subscriber = $this->createSubscriber();
    }

    /**
     * {@inheritDoc}
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->dispatcher, $this->subscriber);
    }

    /**
     * @return EventSubscriberInterface&MockObject
     * @throws Exception
     */
    protected function createSubscriber(): EventSubscriberInterface
    {
        return $this->getMockBuilder(TestEventSubscriber::class)
            ->onlyMethods(['test'])
            ->getMock()
        ;
    }

    protected function createEvent(): EventInterface
    {
        return $this->getMockBuilder(AbstractEvent::class)
            ->setMockClassName('TestEvent')
            ->onlyMethods([])
            ->getMock()
        ;
    }

    /**
     * @covers
     * @return void
     */
    public function testAttachSubscriber(): void
    {
        $this->assertFalse($this->dispatcher->hasSubscriber('testSubscriber'));

        $this->dispatcher->attachSubscriber($this->subscriber, 'testSubscriber');

        $this->assertTrue($this->dispatcher->hasSubscriber('testSubscriber'));
    }

    /**
     * @covers
     * @return void
     */
    public function testDetachAll(): void
    {
        $this->dispatcher->attachSubscriber($this->subscriber, 'testSubscriber');
        $this->dispatcher->detachAll();
        $this->assertFalse($this->dispatcher->hasSubscriber('testSubscriber'));
    }

    /**
     * @covers
     * @return void
     */
    public function testDetachSubscriber()
    {
        $this->dispatcher->attachSubscriber($this->subscriber, 'testSubscriber');
        $detached = $this->dispatcher->detachSubscriber('testSubscriber');

        $this->assertFalse($this->dispatcher->hasSubscriber('testSubscriber'));
        $this->assertEquals(spl_object_hash($detached), spl_object_hash($this->subscriber));
    }

    /**
     * @covers
     * @return void
     * @throws Exception
     */
    public function testDispatch(): void
    {
        $event = $this->createEvent();

        $this->subscriber->expects($this->once())
            ->method('test')
            ->with($event)
        ;

        $this->dispatcher->attachSubscriber($this->subscriber);
        $this->dispatcher->dispatch($event);
    }
}
