<?php

namespace Ncurses\Event;

use \Ncurses\Event\EventInterface;

/**
 * An Event object contains an event type and a readonly set of member data.
 * Event objects are retrieved from the event queue.
 */
class Event implements EventInterface
{
    protected $type;
    protected $attributes;

    /**
     * Constructor
     *
     * @param integer $type
     * @param array   $attributes
     */
    public function __construct($type = self::TYPE_USER, array $attributes = array())
    {
        $this->type       = $type;
        $this->attributes = $attributes;
    }

    public function __get($key)
    {
        if ($key === 'type') {
            return $this->type;
        }

        return $this->attributes[$key];
    }

    public function __isset($key)
    {
        return array_key_exists($key, $this->attributes);
    }
}