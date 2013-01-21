<?php

namespace Ncurses\Event;

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
            default:
                $this->enqueue(new KeyEvent($ch));
                break;
        }
    }
}