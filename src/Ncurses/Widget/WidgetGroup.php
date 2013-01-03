<?php

namespace Ncurses\Widget;

use Ncurses\Window;
use Ncurses\Widget\WidgetGroup;

/**
 * Widget Group
 */
class WidgetGroup implements \IteratorAggregate, \Countable
{
    /**
     * @var array
     */
    protected $widgets = array();

    /**
     * Add Widget.
     *
     * @param \Ncurses\Widget\Widget $widget
     */
    public function add(Widget $widget)
    {
        $this->widgets[spl_object_hash($widget)] = $widget;
    }

    /**
     * Checks if it contains a specific Widget.
     *
     * @param \Ncurses\Widget\Widget $widget
     * @return boolean
     */
    public function has(Widget $widget)
    {
        return array_key_exists(spl_object_hash($widget), $this->widgets);
    }

    /**
     * Draws all widgets into the Window.
     *
     * @param \Ncurses\Window $window
     */
    public function draw(Window $window)
    {
        foreach ($this->widgets as $widget) {
            $widget->draw($window);
        }
    }

    /**
     * Returns an iterator for widgets.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->widgets);
    }

    /**
     * Returns the number of widgets.
     *
     * @return integer
     */
    public function count()
    {
        return count($this->widgets);
    }
}