<?php

namespace Ncurses\Util;

/**
 * Object for storing rectangular coordinates.
 */
class Rect
{
    public $top;
    public $left;
    public $rows;
    public $cols;

    /**
     * Constuctor.
     *
     * @param integer $top
     * @param integer $left
     * @param integer $rows
     * @param integer $cols
     */
    public function __construct($top, $left, $rows = null, $cols = null)
    {
        $this->top  = $top;
        $this->left = $left;
        $this->rows = $rows;
        $this->cols = $cols;
    }

    public function __get($key)
    {
        switch ($key) {
            case 'bottom':
                return $this->top + $this->rows;
            case 'right':
                return $this->left + $this->cols;
            case 'center':
                return array($this->centery, $this->centerx);
            case 'centery':
                return $this->top + floor($this->rows / 2);
            case 'centerx':
                return $this->left + floor($this->cols / 2);
        }

        throw new \OutOfBoundsException('Invalid key.');
    }

    public function __set($key, $value)
    {
        if ($key === 'center') {
            if (!is_array($value) || count($value) !== 2) {
                throw new \InvalidArgumentException(
                    'Center must be an two value array.'
                );
            }
        } elseif (!is_numeric($value)) {
            throw new \InvalidArgumentException(
                'Value must be a number.'
            );
        }

        switch ($key) {
            case 'bottom':
                $this->top = $value - $this->rows;
                break;
            case 'right':
                $this->left = $value - $this->cols;
                break;
            case 'center':
                $this->centery = $value[0];
                $this->centerx = $value[1];
                break;
            case 'centery':
                $this->top  = $value - ceil($this->rows / 2);
                break;
            case 'centerx':
                $this->left = $value - ceil($this->cols / 2);
                break;
            default:
                throw new \OutOfBoundsException('Invalid key.');
        }
    }
}