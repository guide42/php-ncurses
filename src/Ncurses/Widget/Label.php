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
    protected $label;

    public $bold = false;
    public $underline = false;
    public $reverse = false;
    public $blink = false;

    /**
     * Constructor.
     *
     * @param string $label
     * @param \Ncurses\Util\Rect $rect
     */
    public function __construct($label, Rect $rect)
    {
        if (false !== strpos($label, "\n")) {
            throw new \InvalidArgumentException(
                'Label cannot have breaklines. Use Widget\\Text instead.'
            );
        }

        if (null !== $rect->rows || null !== $rect->cols) {
            throw new \InvalidArgumentException(
                'Labels cannot be constraint. Use Widget\\Text instead.'
            );
        }

        parent::__construct($rect);

        $this->label = $label;
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

        ncurses_mvwaddstr($window->getResource(),
            $this->rect->top,
            $this->rect->left,
            $this->label
        );

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