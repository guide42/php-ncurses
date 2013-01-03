<?php

$basedir = dirname(__DIR__);

include_once $basedir . '/src/Ncurses/Ncurses.php';
include_once $basedir . '/src/Ncurses/Event/Queue.php';
include_once $basedir . '/src/Ncurses/Event/EventInterface.php';
include_once $basedir . '/src/Ncurses/Event/Event.php';
include_once $basedir . '/src/Ncurses/Util/Rect.php';
include_once $basedir . '/src/Ncurses/Widget/Widget.php';
include_once $basedir . '/src/Ncurses/Widget/WidgetGroup.php';
include_once $basedir . '/src/Ncurses/Widget/Label.php';
include_once $basedir . '/src/Ncurses/Window.php';

use Ncurses\Ncurses;
use Ncurses\Event\Event;
use Ncurses\Util\Rect;
use Ncurses\Window;
use Ncurses\Widget;

// Init Ncurses
$ncurses = new Ncurses();
$person = new Widget\Label(" O\n/|\\\n ^", new Rect(1, 1));

// Create a Window with a Hello World centered
$window = new Window(new Rect(0, 0, 24, 96));
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