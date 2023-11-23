<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Framework\Routing\Router;

return function (Router $router) {
    $router->setNamespace('App\Http\Controllers');
    $router->get('/', 'HomeController@getHome');
    $router->get('/test', 'HomeController@getHome');
    $router->post('/users', 'UserController@create');
    $router->get( '/users/{id}', 'UserController@get');
};
