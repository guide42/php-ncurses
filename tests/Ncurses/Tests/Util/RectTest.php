<?php

namespace Ncurses\Tests\Util;

use Ncurses\Util\Rect;

/**
 * Rect Test
 */
class RectTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $rect = new Rect(1, 2, 3, 4);

        $this->assertEquals(1, $rect->top, '__construct() takes top as 1st argument');
        $this->assertEquals(2, $rect->left, '__construct() takes left as 2nd argument');
        $this->assertEquals(3, $rect->rows, '__construct() takes rows as 3rd argument');
        $this->assertEquals(4, $rect->cols, '__construct() takes cols as 4th argument');
    }

    public function testGetVirtual()
    {
        $rect = new Rect(12, 6, 24, 36);

        $this->assertEquals(36, $rect->bottom, '__get() must calculate bottom');
        $this->assertEquals(42, $rect->right, '__get() must calculate right');
        $this->assertEquals(array(24, 24), $rect->center, '__get() must calculate center');
    }

    public function testGetVirtualNotFound()
    {
        $this->setExpectedException('OutOfBoundsException');

        $rect = new Rect(7, 7, 7, 7);
        $rect->none;
    }

    public function testSetVirtualCenterWithInteger()
    {
        $this->setExpectedException('InvalidArgumentException');

        $rect = new Rect(12, 6, 24, 36);
        $rect->center = 123;
    }

    public function testSetVirtualCenterWithInvalidArray()
    {
        $this->setExpectedException('InvalidArgumentException');

        $rect = new Rect(12, 6, 24, 36);
        $rect->center = array(123, 321, 999);
    }

    public function testSetVirtualWithNotNumeric()
    {
        $this->setExpectedException('InvalidArgumentException');

        $rect = new Rect(12, 6, 24, 36);
        $rect->bottom = 'h3110';
    }

    public function testSetVirutal()
    {
        $rect = new Rect(3, 3, 12, 6);

        $rect->bottom = 18;
        $this->assertEquals(6, $rect->top, '__set() of bottom must change top');

        $rect->right = 12;
        $this->assertEquals(6, $rect->left, '__set() of right must change left');

        $rect->center = array(12, 12);
        $this->assertEquals(6, $rect->top, '__set() of center must change top');
        $this->assertEquals(9, $rect->left, '__set() of center must change left');
    }

    public function testSetVirutalNotFound()
    {
        $this->setExpectedException('OutOfBoundsException');

        $rect = new Rect(7, 7, 7, 7);
        $rect->none = 7777;
    }
}