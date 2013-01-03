<?php

namespace Ncurses\Event;

/**
 * The queue is a regular queue of Event objects.
 */
class Queue extends \SplQueue
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
            case NCURSES_KEY_MOUSE:
                if (!ncurses_getmouse($mevent)) {
                    $this->enqueue(new Event(Event::TYPE_MOUSE, $mevent));
                }
                break;

            default:
                $this->enqueue(new Event(Event::TYPE_KEY, array(
                    'key' => $ch,
                )));
                break;
        }
    }
}