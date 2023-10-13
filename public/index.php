<?php

require __DIR__ . '/../vendor/autoload.php';

// @todo request package +

$framework->init();



    $router = new \Bramus\Router\Router();
    $router->get('/' , '' );

    $router->run();