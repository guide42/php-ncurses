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

    protected $rows;
    protected $cols;

    /**
     * Constructor.
     *
     * @param string $text
     * @param \Ncurses\Util\Rect $rect
     */
    public function __construct($text, Rect $rect)
    {
        parent::__construct($rect);

        if ($rect->rows !== null) {
            $this->rows = $rect->rows;
        }
        if ($rect->cols !== null) {
            $this->cols = $rect->cols;
        }

        $this->setText($text);
    }

    /**
     * Assign text.
     *
     * @param string $text
     */
    public function setText($text)
    {
        $this->lines = explode(PHP_EOL, $text);

        if (null !== $this->rows) {
            $this->rect->rows = count($this->lines);
        } else {
            $this->rect->rows = $this->rows;
        }

        if (null !== $this->cols) {
            $cols = 0;

            foreach ($this->lines as $line) {
                $cols = max(array(strlen($line), $cols));
            }

            $this->rect->cols = $cols;
        } else {
            $this->rect->cols = $this->cols;
        }
    }

    /**
     * (non-PHPdoc)
     * @see \Ncurses\Widget\Widget::draw()
     */
    public function draw(Window $window)
    {
        foreach ($this->lines as $i => $line) {
            if (null !== $this->rows && $i >= $this->rows) {
                break;
            }

            if (null !== $this->cols) {
                $line = substr($line, 0, $this->cols);
            }

            ncurses_mvwaddstr($window->getResource(),
                $this->rect->top + $i,
                $this->rect->left,
                $line
            );
        }
    }
}