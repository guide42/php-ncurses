<?php

include_once __DIR__ . '/../src/bootstrap.php';

use Ncurses\Ncurses;

$ncurses = new Ncurses();
$ncurses->start();
$ncurses->sleep(1000);
$ncurses->stop();