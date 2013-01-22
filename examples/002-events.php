<?php
/*!
 * 002 Events Example
 *
 * Will log every event until the escape key is pressed. After stoping the
 * ncurses mode, will print the logged events.
 */

include_once __DIR__ . '/../src/bootstrap.php';

use Ncurses\Ncurses;

$ncurses = new Ncurses();
$ncurses->start();

$events = array();

while (true) {
    foreach ($ncurses->events as $event) {
        $events[] = strval($event);

        if ($event instanceof \Ncurses\Event\KeyEvent && 27 === $event->key) {
            break 2;
        }
    }

    $ncurses->refresh();
    $ncurses->events->process();
}

$ncurses->stop();

printf('%d events: ', count($events));
print_r($events);