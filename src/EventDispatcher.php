<?php

namespace Silencenjoyer\Observer;

use Silencenjoyer\Observer\Events\EventInterface;

/**
 * Class EventDispatcher
 *
 * @package Silencenjoyer\Observer\Events
 */
class EventDispatcher implements EventDispatcherInterface
{
    protected array $subscribers = [];
    /**
     * @var array<callable>
     */
    protected array $eventMap = [];

    /**
     * {@inheritDoc}
     * @param EventSubscriberInterface $subscriber
     * @return $this
     */
    public function attachSubscriber(
        EventSubscriberInterface $subscriber,
        ?string $name = null
    ): self {
        $name = $name ?? spl_object_hash($subscriber);

        $this->subscribers[$name] = $subscriber;

        foreach ($subscriber->events() as $event => $method) {
            $this->eventMap[$event][$name][] = [$subscriber, $method];
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     * @return EventDispatcherInterface
     */
    public function detachAll(): self
    {
        $this->subscribers = [];
        return $this;
    }

    /**
     * {@inheritDoc}
     * @param string $name
     * @return EventSubscriberInterface|null
     */
    public function detachSubscriber(string $name): ?EventSubscriberInterface
    {
        if (!$this->hasSubscriber($name)) {
            return null;
        }

        $subscriber = $this->subscribers[$name];
        unset($this->subscribers[$name]);

        foreach ($this->eventMap as $event => &$subscribers) {
            unset($subscribers[$name]);
            if (empty($subscribers)) {
                unset($this->eventMap[$event]);
            }
        }

        return $subscriber;
    }

    /**
     * {@inheritDoc}
     * @param string $name
     * @return bool
     */
    public function hasSubscriber(string $name): bool
    {
        return isset($this->subscribers[$name]);
    }

    /**
     * {@inheritDoc}
     * @param EventInterface $event
     * @return void
     */
    public function dispatch(EventInterface $event): void
    {
        if ($event->isHandled()) {
            return;
        }

        $eventName = get_class($event);

        if (!isset($this->eventMap[$eventName])) {
            return;
        }

        foreach ($this->eventMap[$eventName] as $methods) {
            foreach ($methods as [$subscriber, $method]) {
                $subscriber->$method($event);
                if ($event->isHandled()) {
                    return;
                }
            }
        }
    }
}
