<?php

namespace Silencenjoyer\Observer\Events;

/**
 * Class Event
 *
 * @package Silencenjoyer\Observer\Events
 */
abstract class AbstractEvent implements EventInterface
{
    protected bool $handled = false;

    /**
     * {@inheritDoc}<br>
     * Returns the event class name converted to readable form.
     *
     * @return string
     */
    public function getDescription(): string
    {
        $words = preg_split('/(?=[A-Z])|_/', static::class);
        $words = array_filter($words);

        $formattedWords = array_map('ucfirst', $words);

        return implode(' ', $formattedWords);
    }

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function isHandled(): bool
    {
        return $this->handled;
    }

    /**
     * {@inheritDoc}
     * @return void
     */
    public function handle(): void
    {
        $this->handled = true;
    }

    /**
     * {@inheritDoc}
     * @return void
     */
    public function unHandle(): void
    {
        $this->handled = false;
    }
}
