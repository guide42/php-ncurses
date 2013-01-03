<?php

namespace Ncurses\Widget;

use Ncurses\Window;
use Ncurses\Widget\Widget;
use Ncurses\Util\Rect;

/**
 * Label Widget
 */
class Label extends Widget
{
    protected $lines;

    /**
     * Constructor.
     *
     * @param string $text
     * @param \Ncurses\Util\Rect $rect
     */
    public function __construct($text, Rect $rect)
    {
        $lines = explode("\n", $text);
        $cols  = 0;

        foreach ($lines as $line) {
            $cols = max(array(strlen($line), $cols));
        }

        $rect->rows = count($lines);
        $rect->cols = $cols;

        parent::__construct($rect);

        $this->lines = $lines;
    }

    /**
     * (non-PHPdoc)
     * @see \Ncurses\Widget\Widget::draw()
     */
    public function draw(Window $window)
    {
        foreach ($this->lines as $i => $line) {
            ncurses_mvwaddstr($window->getResource(),
                $this->rect->top + $i,
                $this->rect->left,
                $line
            );
        }
    }
}