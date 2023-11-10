<?php

use App\Http\Controllers\HomeController;
use Framework\Routing\Router;

return function (Router $router) {
    $router->setNamespace('\App\Http\Controllers');
    $router->get('/', 'HomeController@giveLogin');
    $router->get('/test', function () {
        echo 'demo';
    });
};
