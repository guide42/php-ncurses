<?php

namespace Ncurses\Event;

use Ncurses\Event\ResizeEvent;
use Ncurses\Event\KeyEvent;

/**
 * The queue is a regular queue of Event objects.
 */
class EventQueue extends \SplQueue
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        //parent::__construct();

        $this->setIteratorMode(
            \SplDoublyLinkedList::IT_MODE_FIFO |
            \SplDoublyLinkedList::IT_MODE_DELETE
        );
    }

    /**
     * Process events.
     */
    public function process()
    {
        $ch = ncurses_getch();

        switch ($ch) {
            case -1: // ERR
                break;

            case NCURSES_KEY_MOUSE: // 409
                break;

            case NCURSES_KEY_RESIZE: // 410
                $rows = null;
                $cols = null;

                // Gets the horizontal and vertical size of the main window,
                // which must be the same as the terminal size.
                ncurses_getmaxyx(STDSCR, $rows, $cols);

                $this->enqueue(new ResizeEvent($rows, $cols));
                break;

            default:
                $this->enqueue(new KeyEvent($ch));
                break;
        }
    }
}