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

    public $rows;
    public $cols;

    /**
     * Constructor.
     */
    public function __construct()
    {
        ncurses_init();
        ncurses_cbreak();
        ncurses_noecho();
        ncurses_nonl();

        ncurses_getmaxyx(STDSCR, $this->rows, $this->cols);

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
     * Stop using ncurses, clean up the screen.
     */
    public function stop()
    {
        if (!ncurses_isendwin()) {
            ncurses_def_prog_mode();
        }

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
        if (ncurses_isendwin()) {
            ncurses_reset_prog_mode();
        }

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
}