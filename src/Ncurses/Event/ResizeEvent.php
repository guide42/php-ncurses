<?php

namespace Ncurses\Event;

use Ncurses\Event\Event;

/**
 * Resize Event.
 */
class ResizeEvent extends Event
{
    public $rows;
    public $cols;

    /**
     * Constructor.
     *
     * @param integer $rows
     * @param integer $cols
     */
    public function __construct($rows, $cols)
    {
        $this->rows = $rows;
        $this->cols = $cols;
    }

    /**
     * String representation.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('<Resize (%d,%d)>', $this->rows, $this->cols);
    }
}