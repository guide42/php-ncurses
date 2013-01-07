<?php

include_once 'bootstrap.php';

use Ncurses\Ncurses;
use Ncurses\Event\Event;
use Ncurses\Util\Rect;
use Ncurses\Window;
use Ncurses\Widget;

// Init Ncurses
$ncurses = new Ncurses();
$ncurses->cursorVisibility(false);

// Create a Window the same size of the Screen
$window = new Window(new Rect(0, 0, $ncurses->rows, $ncurses->cols));

// Create a center Hello World label
$helloWorld = new Widget\Label('Hello World', new Rect(0, 0));
$helloWorld->rect->center = $window->rect->center;
$helloWorld->bold = true;
$window->widgets->add($helloWorld);

// Create person
$person = new Widget\Text(" O\n/|\\\n ^", new Rect(1, 1));
$window->widgets->add($person);

while (true) {
    foreach ($ncurses->events as $event) {
        if ($event->type === Event::TYPE_KEY) {
            if ($event->key === 113) {
                return;
            } elseif ($event->key === NCURSES_KEY_LEFT) {
                $person->rect->left -= 1;
            } elseif ($event->key === NCURSES_KEY_RIGHT) {
                $person->rect->left += 1;
            } elseif ($event->key === NCURSES_KEY_DOWN) {
                $person->rect->top += 1;
            } elseif ($event->key === NCURSES_KEY_UP) {
                $person->rect->top -= 1;
            }
        }
    }

    $window->refresh();

    $ncurses->refresh();
    $ncurses->events->process();
}