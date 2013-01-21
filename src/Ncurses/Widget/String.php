<?php

namespace Ncurses\Widget;

use Ncurses\Widget\Widget;
use Ncurses\Util\Rect;

/**
 * String Widget
 */
class String extends Widget
{
    protected $string;

    /**
     * Constructor.
     *
     * @param string $string
     * @param \Ncurses\Util\Rect $rect
     */
    public function __construct($string, Rect $rect)
    {
        parent::__construct($rect);

        $this->string = $string;
    }

    /**
     * (non-PHPdoc)
     * @see \Ncurses\Widget\Widget::draw()
     */
    public function draw()
    {
        ncurses_mvwaddstr($this->getWindow()->getResource(),
            $this->rect->top,
            $this->rect->left,
            $this->string
        );
    }
}