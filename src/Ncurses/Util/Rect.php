<?php

namespace Ncurses\Util;

/**
 * Object for storing rectangular coordinates.
 */
class Rect
{
    public $top;
    public $left;
    public $rows;
    public $cols;

    /**
     * Constuctor.
     *
     * @param integer $top
     * @param integer $left
     * @param integer $rows
     * @param integer $cols
     */
    public function __construct($top, $left, $rows = null, $cols = null)
    {
        $this->top  = $top;
        $this->left = $left;
        $this->rows = $rows;
        $this->cols = $cols;
    }
}