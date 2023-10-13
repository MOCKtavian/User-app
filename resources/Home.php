<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

$m = new Mustache_Engine;

echo $m->render('Hello');
