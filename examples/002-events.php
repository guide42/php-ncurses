<?php
/*!
 * 002 Events Example
 *
 * Will log every key pressed until the escape key is pressed. After stoping
 * the ncurses mode, will print the logged keys.
 */

include_once __DIR__ . '/../src/bootstrap.php';

use Ncurses\Ncurses;

$ncurses = new Ncurses();
$ncurses->start();

$pressed = array();

while (true) {
    foreach ($ncurses->events as $event) {
        if ($event instanceof \Ncurses\Event\KeyEvent) {
            if (27 === $event->key) {
                break 2;
            } else {
                $pressed[] = $event->key;
            }
        }
    }

    $ncurses->refresh();
    $ncurses->events->process();
}

$ncurses->stop();

printf('You pressed %d keys: ', count($pressed));
print_r($pressed);