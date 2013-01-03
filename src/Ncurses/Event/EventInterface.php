<?php

namespace Ncurses\Event;

/**
 * Event Interface
 */
interface EventInterface
{
    const TYPE_KEY = 1;

    const TYPE_MOUSE = 2;

    const TYPE_USER = 127;
}