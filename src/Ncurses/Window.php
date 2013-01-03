<?php

namespace Ncurses;

use Ncurses\Util\Rect;
use Ncurses\Widget\Widget;
use Ncurses\Widget\WidgetGroup;
use Ncurses\Widget\Label;

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

    /**
     * @var \Ncurses\Widget\WidgetGroup
     */
    public $widgets;

    /**
     * Constructor.
     *
     * @param \Ncurses\Util\Rect $rect
     */
    public function __construct(Rect $rect)
    {
        $this->rect = $rect;

        $this->window = ncurses_newwin(
            $this->rect->rows,
            $this->rect->cols,
            $this->rect->top,
            $this->rect->left
        );

        if (!$this->window) {
            ncurses_addstr('Window cannot be created.');
        }

        $this->widgets = new WidgetGroup();
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
     * Erase window contents.
     */
    public function erase()
    {
        ncurses_werase($this->window);
    }

    /**
     * Copies window to virtual screen. If $force is TRUE, refresh window on
     * terminal screen directly.
     *
     * @param boolean $force
     */
    public function refresh($force = false)
    {
        $this->erase();
        $this->widgets->draw($this);

        if ($force) {
            ncurses_wrefresh($this->window);
        } else {
            ncurses_wnoutrefresh($this->window);
        }
    }

    /**
     * Draws a border around the window using attributed characters.
     */
    public function border()
    {
        ncurses_wborder($this->window, 0, 0, 0, 0, 0, 0, 0, 0);
    }
}