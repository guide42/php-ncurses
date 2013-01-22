<?php

namespace Ncurses\Event;

use Ncurses\Event\Event;

/**
 * Keyboard Event.
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

    /**
     * String representation.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('<Key (%d)>', $this->key);
    }
}