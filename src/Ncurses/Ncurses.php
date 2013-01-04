<?php

namespace Ncurses;

use Ncurses\Util\Rect;
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
        ncurses_cbreak();
        ncurses_noecho();
        ncurses_nonl();

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

    /**
     * Set cursor visibility.
     *
     * @param boolean $visibility
     */
    public function cursorVisibility($visibility)
    {
        ncurses_curs_set($visibility ? 1 : 0);
    }

    /**
     * Returns the Screen Rect.
     *
     * @return \Ncurses\Util\Rect
     */
    public function getScreenRect()
    {
        ncurses_getmaxyx(STDSCR, $y, $x);
        return new Rect(0, 0, $y, $x);
    }
}