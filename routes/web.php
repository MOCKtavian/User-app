<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Framework\Routing\Router;

return function (Router $router) {
    $router->setNamespace('App\Http\Controllers');

    $router->get('/', 'HomeController@getHome');
    $router->get('/test', 'HomeController@getHome');

    $router->get('/users/(\d+)', 'UserController@fetchUser');
    $router->post('/users/fetchAll', 'UserController@showUsers');
    $router->post('/users/register', 'UserController@create');
    $router->delete('/users/(\d+)/delete', 'UserController@deleteUser');
};