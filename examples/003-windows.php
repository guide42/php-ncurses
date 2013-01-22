<?php
/*!
 * Windows Example
 *
 * Creates two windows of 5 rows 10 cols with a visible border and draw them in
 * the screen.
 */

include_once __DIR__ . '/../src/bootstrap.php';

use Ncurses\Ncurses;
use Ncurses\Util\Rect;
use Ncurses\Window\Window;

$ncurses = new Ncurses();
$ncurses->start();

$window0 = new Window('win0', new Rect(5, 10, 5, 10));
$window0->border = true;
$window0->draw();
$window0->refresh();

$window1 = new Window('win1', new Rect(5, 20, 5, 10));
$window1->border = true;
$window1->draw();
$window1->refresh();

$ncurses->refresh();
$ncurses->events->process();

$ncurses->stop();