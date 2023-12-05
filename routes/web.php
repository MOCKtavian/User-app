<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Framework\Routing\Router;

return function (Router $router) {
    $router->setNamespace('App\Http\Controllers');

    $router->get('/', 'HomeController@getHome');
    $router->get('/users/{id}/fetch', 'UserController@fetchUser');
    $router->get('/users/fetchAll', 'UserController@showUsers');
    $router->post('/users/register', 'UserController@create');
    $router->patch('/users/update', 'UserController@updateUser');
    $router->delete('/users/{id}/delete', 'UserController@deleteUser');

};