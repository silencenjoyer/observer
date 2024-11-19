<?php

namespace Silencenjoyer\Observer\Tests\EventSubscribers;

use Silencenjoyer\Observer\Events\EventInterface;
use Silencenjoyer\Observer\EventSubscriberInterface;

/**
 * Class TestEventSubscriber
 *
 * @package Silencenjoyer\Observer\Tests
 */
class TestEventSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritDoc}
     * @return iterable
     */
    public function events(): iterable
    {
        return ['TestEvent' => 'test'];
    }

    /**
     * @param EventInterface $event
     * @return void
     */
    public function test(EventInterface $event): void
    {
    }
}
