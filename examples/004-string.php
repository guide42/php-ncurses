<?php
/*!
 * String Example
 */

include_once __DIR__ . '/../src/bootstrap.php';

use Ncurses\Ncurses;
use Ncurses\Util\Rect;
use Ncurses\Window\Window;
use Ncurses\Widget;

$ncurses = new Ncurses();
$ncurses->start();

$window = new Window(new Rect(0, 0, $ncurses->rows, $ncurses->cols));
$window->border = true;

$string = new Widget\String('Hello World!', new Rect(0, 0));
$string->rect->center = $window->rect->center;
$string->setWindow($window);
$string->draw();

$window->draw();
$window->refresh();

$ncurses->refresh();
$ncurses->events->process();

$ncurses->stop();