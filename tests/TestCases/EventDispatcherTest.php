<?php

namespace Silencenjoyer\Observer\Tests\TestCases;

use Silencenjoyer\Observer\EventDispatcherInterface;
use Silencenjoyer\Observer\EventDispatcher;

/**
 * Class EventDispatcherTest
 *
 * @package Silencenjoyer\Observer\Tests\TestCases
 */
class EventDispatcherTest extends AbstractEventDispatcher
{
    function createInstance(): EventDispatcherInterface
    {
        return new EventDispatcher();
    }
}
