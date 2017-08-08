<?php


require('src/Proceda.php');
require('src/EDI/Parse.php');
require('src/EDI/Interpreter.php');

use PHPProceda\Proceda;

$file = __DIR__.'/MODELO-NOTFIS.txt';

$proceda = new Proceda($file);

print_R($proceda->parse());exit;
