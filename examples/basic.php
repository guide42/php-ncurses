<?php

include_once __DIR__ . '/../src/bootstrap.php';

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

$helloWorld = new Widget\Label('Hello World', new Rect(0, 0));
$helloWorld->bold = true;

$description = new Widget\Label('. Press Q to exit.', new Rect(0, 11));

$window->widgets->add($helloWorld);
$window->widgets->add($description);

while (true) {
    foreach ($ncurses->events as $event) {
        if ($event->type === Event::TYPE_KEY) {
            if ($event->key === 113) {
                return;
            }
        }
    }

    $window->refresh();

    $ncurses->refresh();
    $ncurses->events->process();
}