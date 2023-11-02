<?php

use Framework\Views\Renderers\MustacheViewRenderer;
use Framework\Views\ViewRenderer;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ .  "/../routes/web.php";

//$framework->init();

$builder = new \DI\ContainerBuilder();

$container = $builder->build();

$container->set(Request::class, Request::createFromGlobals());

$container->set('request', \DI\get(Request::class));

dd(
    $container->get(Request::class) === $container->get(Request::class),
    $container->get(Request::class) === $container->get('request'),
    $container->get(Request::class)
);

$m = new Mustache_Engine();
$container->set(ViewRenderer::class, new MustacheViewRenderer(new Mustache_Engine([
    'loader' => new Mustache_Loader_FilesystemLoader(getcwd(). '\\..\\resources\\views\\')
])));

$router = new \Framework\Routing\Router($container);
$router->setNamespace('App\\Http\\Controllers\\');
$router->get('demo', 'HomeController@showDemo');
$router->run();

