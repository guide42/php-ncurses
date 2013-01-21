<?php
/*!
 * Basic Example
 *
 * This will create a ncurses instance, start it, wait for one second and stop
 * it before exit the program.
 */

include_once __DIR__ . '/../src/bootstrap.php';

use Ncurses\Ncurses;

$ncurses = new Ncurses();
$ncurses->start();
$ncurses->sleep(1000);
$ncurses->stop();