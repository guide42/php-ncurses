<?php

include_once __DIR__ . '/../src/bootstrap.php';

use Ncurses\Ncurses;
use Ncurses\Event\Event;
use Ncurses\Util\Rect;
use Ncurses\Window;
use Ncurses\Widget;

$text = <<<EOF
The curses package is a subroutine library for terminal-independent
screen-painting and input-event handling which presents a high level
screen model to the programmer, hiding differences between terminal
types and doing automatic optimization of output to change one screen
full of text into another. Curses uses terminfo, which is a database
format that can describe the capabilities of thousands of different
terminals.

Press any key to exit.
EOF;

$ncurses = new Ncurses();
$ncurses->cursorVisibility(false);

$widget = new Widget\Text($text, new Rect(0, 0));

$window = new Window(new Rect(0, 0, $ncurses->rows, $ncurses->cols));
$window->widgets->add($widget);
$window->refresh();

$ncurses->refresh();
$ncurses->events->process();