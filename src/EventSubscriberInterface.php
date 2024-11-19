<?php

namespace Silencenjoyer\Observer;

/**
 * Interface EventSubscriberInterface
 *
 * @package Silencenjoyer\Observer
 */
interface EventSubscriberInterface
{
    /**
     * Provides a list of subscribed events and methods to call.
     * Implementation example:
     * ```
     *     class Subscriber implements EventSubscriberInterface
     *      {
     *          public function events(): iterable
     *          {
     *              yield SpecificEvent::class => 'prepare';
     *              yield SpecificEvent::class => 'saveToDb';
     *          }
     *
     *          public function prepare(EventInterface $event): void
     *          {
     *              // do something
     *          }
     *
     *          public function saveToDb(EventInterface $event): void
     *          {
     *              // do something
     *          }
     *      }
     * ```
     *
     * @return iterable class-string => string
     */
    public function events(): iterable;
}
