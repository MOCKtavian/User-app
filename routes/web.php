<?php

use App\Http\Controllers\HomeController;
use Framework\Routing\Router;

return function (Router $router) {
    $router->get('/', HomeController::class);
    $router->get('/test', fn () => 'demo');
};
