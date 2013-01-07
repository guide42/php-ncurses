<?php

include_once 'bootstrap.php';

use Ncurses\Ncurses;
use Ncurses\Event\Event;
use Ncurses\Util\Rect;
use Ncurses\Window;
use Ncurses\Widget;

$text = <<<EOF
This document is an introduction to programming with curses. It is not an
exhaustive reference for the curses Application Programming Interface (API);
that role is filled by the curses manual pages. Rather, it is intended to help
C programmers ease into using the package.

This document is aimed at C applications programmers not yet specifically
familiar with ncurses. If you are already an experienced curses programmer, you
should nevertheless read the sections on Mouse Interfacing, Debugging,
Compatibility with Older Versions, and Hints, Tips, and Tricks. These will
bring you up to speed on the special features and quirks of the ncurses
implementation. If you are not so experienced, keep reading.

The curses package is a subroutine library for terminal-independent screen-painting and input-event handling which presents a high level screen model to the programmer, hiding differences between terminal types and doing automatic optimization of output to change one screen full of text into another. Curses uses terminfo, which is a database format that can describe the capabilities of thousands of different terminals.
EOF;

$ncurses = new Ncurses();

$widget0 = new Widget\Text($text, new Rect(0, 0, 8, 72));
$widget1 = new Widget\Text($text, new Rect(15, 0, null, 72));
$widget2 = new Widget\Text($text, new Rect(30, 0, null, null));

$window = new Window(new Rect(0, 0, $ncurses->rows, $ncurses->cols));
$window->widgets->add($widget0);
$window->widgets->add($widget1);
$window->widgets->add($widget2);
$window->refresh();

$ncurses->refresh();
$ncurses->events->process();