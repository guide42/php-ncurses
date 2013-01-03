<?php

namespace Ncurses;

use Ncurses\Event\Queue as EventQueue;
use Ncurses\Event\Event;

/**
 * Ncurses
 */
class Ncurses
{
    /**
     * @var \Ncurses\Event\Queue
     */
    public $events;

    /**
     * Constructor.
     */
    public function __construct()
    {
        ncurses_init();
        ncurses_noecho();

        $this->events = new EventQueue();
        $this->refresh(true);
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        ncurses_end();
    }

    /**
     * Compares the virtual screen to the physical screen and updates the
     * physical screen. If $force is TRUE, updates everything.
     *
     * @param boolean $force
     */
    public function refresh($force = false)
    {
        ncurses_move(0, 0);

        if ($force) {
            ncurses_refresh();
        } else {
            ncurses_doupdate();
        }
    }

    /**
     * Sleep.
     *
     * @param integer $milliseconds
     */
    public function sleep($milliseconds)
    {
        ncurses_napms($milliseconds);
    }
}