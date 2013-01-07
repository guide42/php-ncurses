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

    public $bold = false;
    public $underline = false;
    public $reverse = false;
    public $blink = false;

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
        if ($this->bold) {
            ncurses_wattron($window->getResource(), NCURSES_A_BOLD);
        }

        if ($this->underline) {
            ncurses_wattron($window->getResource(), NCURSES_A_UNDERLINE);
        }

        if ($this->reverse) {
            ncurses_wattron($window->getResource(), NCURSES_A_REVERSE);
        }

        if ($this->blink) {
            ncurses_wattron($window->getResource(), NCURSES_A_BLINK);
        }

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

        if ($this->bold) {
            ncurses_wattroff($window->getResource(), NCURSES_A_BOLD);
        }

        if ($this->underline) {
            ncurses_wattroff($window->getResource(), NCURSES_A_UNDERLINE);
        }

        if ($this->reverse) {
            ncurses_wattroff($window->getResource(), NCURSES_A_REVERSE);
        }

        if ($this->blink) {
            ncurses_wattroff($window->getResource(), NCURSES_A_BLINK);
        }
    }
}