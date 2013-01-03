<?php

namespace Ncurses\Widget;

use Ncurses\Window;
use Ncurses\Util\Rect;

/**
 * Base Widget
 */
abstract class Widget
{
    /**
     * @var \Ncurses\Util\Rect
     */
    public $rect;

    /**
     * Constructor.
     *
     * @param \Ncurses\Util\Rect $rect
     */
    public function __construct(Rect $rect)
    {
        $this->rect = $rect;
    }

    /**
     * Draws a Widget into the Window.
     *
     * @param \Ncurses\Window $window
     */
    abstract public function draw(Window $window);
}