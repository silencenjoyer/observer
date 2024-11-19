<?php

namespace Silencenjoyer\Observer\Events;

/**
 * Interface EventInterface
 *
 * @package Silencenjoyer\Observer\Events
 */
interface EventInterface
{
    /**
     * Get a short description of the event.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * An indication of whether the event has already been processed
     * and whether further processing should be stopped.
     *
     * @return bool
     */
    public function isHandled(): bool;

    /**
     * Mark an Event as handled.
     *
     * @return void
     */
    public function handle(): void;

    /**
     * Mark an Event as unhandled.
     *
     * @return void
     */
    public function unHandle(): void;
}
