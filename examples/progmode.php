<?php

include_once __DIR__ . '/../src/bootstrap.php';

use Ncurses\Ncurses;
use Ncurses\Event\Event;
use Ncurses\Util\Rect;
use Ncurses\Window;
use Ncurses\Widget;

$description = 'You are in Ncurses.'
             . ' Press L to execute an `ls` command.'
             . ' Press Q to exit.';

$ncurses = new Ncurses();
$ncurses->cursorVisibility(false);

$window = new Window(new Rect(0, 0, $ncurses->rows, $ncurses->cols));
$window->widgets->add(new Widget\Label($description, new Rect(0, 0)));
$window->refresh();

while (true) {
    foreach ($ncurses->events as $event) {
        if ($event->type === Event::TYPE_KEY) {
            if ($event->key === 113) {
                return;
            } elseif ($event->key === 108) {
                $ncurses->stop();
                system('ls -lh');
                sleep(3);
            }
        }
    }

    $ncurses->refresh();
    $ncurses->events->process();
}