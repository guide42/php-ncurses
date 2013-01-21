<?php

namespace Ncurses\Widget;

use Ncurses\Window\Window;
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
     * @var \Ncurses\Window\Window
     */
    protected $window;

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
     * Set the Widget Window
     *
     * @param \Ncurses\Window\Window $window
     */
    public function setWindow(Window $window)
    {
        $this->window = $window;
    }

    /**
     * Get the Widget Window.
     *
     * @return \Ncurses\Window\Window
     */
    public function getWindow()
    {
        return $this->window;
    }

    /**
     * Draws a Widget into the Window.
     */
    abstract public function draw();
}