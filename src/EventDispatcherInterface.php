<?php

namespace Silencenjoyer\Observer;

use Silencenjoyer\Observer\Events\EventInterface;

/**
 * Interface EventDispatcherInterface
 */
interface EventDispatcherInterface
{
    /**
     * Collects subscriber for listening events.
     *
     * @param EventSubscriberInterface $subscriber
     * @param string|null $name
     * @return self
     */
    public function attachSubscriber(
        EventSubscriberInterface $subscriber,
        ?string $name = null
    ): self;

    /**
     * Deletes named subscriber for listening events.
     *
     * @param string $name
     * @return EventSubscriberInterface|null
     */
    public function detachSubscriber(string $name): ?EventSubscriberInterface;

    /**
     * An indication of whether the named listener is registered.
     *
     * @param string $name
     * @return bool
     */
    public function hasSubscriber(string $name): bool;

    /**
     * Clear subscribers list.
     *
     * @return self
     */
    public function detachAll(): self;

    /**
     * Dispatches events.
     *
     * @param EventInterface $event
     * @return void
     */
    public function dispatch(EventInterface $event): void;
}
