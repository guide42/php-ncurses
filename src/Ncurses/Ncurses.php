<?php

namespace Ncurses;

use Ncurses\Event\EventQueue;

/**
 * Ncurses
 */
class Ncurses
{
    /**
     * @var \Ncurses\Event\EventQueue
     */
    public $events;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->events = new EventQueue();
    }

    /**
     * Start using ncurses.
     */
    public function start()
    {
        if (defined('STDSCR')) {
            return;
        }

        ncurses_init();
        ncurses_cbreak();
        ncurses_noecho();
        ncurses_nonl();

        ncurses_refresh();
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