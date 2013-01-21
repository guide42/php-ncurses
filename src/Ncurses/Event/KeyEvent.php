<?php

namespace Ncurses\Event;

use Ncurses\Event\Event;

/**
 * A keyboard event.
 */
class KeyEvent extends Event
{
    public $key;

    /**
     * Constructor.
     *
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }
}