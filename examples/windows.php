<?php

include_once 'bootstrap.php';

use Ncurses\Ncurses;
use Ncurses\Event\Event;
use Ncurses\Util\Rect;
use Ncurses\Window;
use Ncurses\Widget;

$ncurses = new Ncurses();
$ncurses->cursorVisibility(false);

$rows = $ncurses->rows;

$toprows = ceil(($ncurses->rows * 80) / 100);
$topcols = $ncurses->cols / 2;

$window0 = new Window(new Rect(0, 0, $toprows, ceil($topcols)));
$window0->border = true;
$window0->widgets->add(new Widget\Label(' This is Window TOPLEFT ', new Rect(0, 1)));
$window0->refresh();

$window1 = new Window(new Rect(0, $window0->rect->right, $toprows, floor($topcols)));
$window1->border = true;
$window1->widgets->add(new Widget\Label(' This is Window TOPRIGHT ', new Rect(0, 1)));
$window1->refresh();

$bottomrows = floor(($ncurses->rows * 20) / 100);

$window1 = new Window(new Rect($window0->rect->bottom, 0, $bottomrows, $ncurses->cols));
$window1->border = true;
$window1->widgets->add(new Widget\Label(' This is Window BOTTOM ', new Rect(0, 1)));
$window1->refresh();

$ncurses->refresh();
$ncurses->events->process();