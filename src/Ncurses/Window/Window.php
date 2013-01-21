<?php

namespace Ncurses\Window;

use Ncurses\Util\Rect;

/**
 * Window
 */
class Window
{
    /**
     * @var resource
     */
    protected $window;

    /**
     * @var \Ncurses\Util\Rect
     */
    public $rect;

    public $border = false;

    /**
     * Constructor.
     *
     * @param \Ncurses\Util\Rect $rect
     */
    public function __construct(Rect $rect)
    {
        $this->rect   = $rect;
        $this->window = ncurses_newwin(
                $this->rect->rows,
                $this->rect->cols,
                $this->rect->top,
                $this->rect->left
        );

        if (!$this->window) {
            throw new \RuntimeException('Window cannot be created.');
        }
    }

    /**
     * Returns window resource.
     *
     * @return resource
     */
    public function getResource()
    {
        return $this->window;
    }

    /**
     * Draw Window attributes.
     */
    public function draw()
    {
        if ($this->border) {
            // Draws a border around the window using attributed characters.
            ncurses_wborder($this->window, 0, 0, 0, 0, 0, 0, 0, 0);
        }
    }

    /**
     * Copies window to virtual screen. If $force is TRUE, refresh window on
     * terminal screen directly.
     *
     * @param boolean $force
     */
    public function refresh($force = false)
    {
        // Erase window contents.
        //ncurses_werase($this->window);

        // Draw Window
        $this->draw();

        if ($force) {
            ncurses_wrefresh($this->window);
        } else {
            ncurses_wnoutrefresh($this->window);
        }
    }
}