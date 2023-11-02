<?php

use Framework\Routing\Router;

return function (Router $router) {
    $router->get('/', function () {
        return 'demo';
    });
};
