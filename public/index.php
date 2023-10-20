<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ .  "/../routes/web.php";

use Providers\Container;
use Symfony\Component\HttpFoundation\Request;
use Views\Home;

//@todo 1) refactor cod ❌, create container ❌,2) configureaza docker❌

//$framework->init();
$request = Request::create("dad");
$controller = new \App\Http\Controllers\HomeController();
$router = new \Bramus\Router\Router();
$router->setNamespace("App\\Http\\Controllers");
$router->get('dad', "HomeController@showDad");
$request = new Request();
$router->get('/Home', function(){
   echo "welcome home";
});
$router->
$router->run();

