<?php

use Framework\Views\Renderers\MustacheViewRenderer;
use Framework\Views\ViewRenderer;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ .  "/../routes/web.php";

//$framework->init();

$builder = new \DI\ContainerBuilder();

$container = $builder->build();

// bind a "singleton" in the container
$container->set(Request::class, Request::createFromGlobals());

// set an alias for a bound form the container
$container->set('request', \DI\get(Request::class));

$container->set(ViewRenderer::class, \DI\value(function () {
    return new MustacheViewRenderer(
        new Mustache_Engine([
            'loader' => new Mustache_Loader_FilesystemLoader(__DIR__. '/../resources/views/')
        ]
    ));
}));

$container->set('view', \DI\get(ViewRenderer::class));

dd(
    $container->get(ViewRenderer::class) === $container->get(ViewRenderer::class),
    $container->get(ViewRenderer::class) === $container->get('view'),
    $container->get(ViewRenderer::class)
);

$router = new \Framework\Routing\Router($container);
$router->setNamespace('App\\Http\\Controllers\\');
$router->get('demo', 'HomeController@showDemo');
$router->run();

