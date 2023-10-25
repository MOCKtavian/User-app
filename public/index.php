<?php

use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ .  "/../routes/web.php";

//@todo 1) singleton de request in container, 2) logica mea pe aplicatie, 3) container-ul sa poata apela functii de controller

//$framework->init();
$builder = new \DI\ContainerBuilder();
$container = $builder->build();
$container->set('request', $request = new Request());
$controller = new \App\Http\Controllers\HomeController();

$router = new \Bootstrap\Routing\Router($container);
$router->setNamespace("App\\Http\\Controllers");
$router->get('dad', "HomeController@showdad");
$router->get('', function(){
   return \Views\Home::class;
});

$router->run();

var_dump($container);

