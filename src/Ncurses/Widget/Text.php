<?php

namespace Ncurses\Widget;

use Ncurses\Window;
use Ncurses\Widget\Widget;
use Ncurses\Util\Rect;

/**
 * Text Widget
 */
class Text extends Widget
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

        if (null === $rect->cols) {
            $cols = 0;

            foreach ($lines as $line) {
                $cols = max(array(strlen($line), $cols));
            }

            $rect->cols = $cols;
        }

        if (null === $rect->rows) {
            $rect->rows = count($lines);
        }

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
            if ($i >= $this->rect->rows) {
                break;
            }

            ncurses_mvwaddstr($window->getResource(),
                $this->rect->top + $i,
                $this->rect->left,
                substr($line, 0, $this->rect->cols)
            );
        }
    }
}