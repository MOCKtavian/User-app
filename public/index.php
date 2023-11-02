<?php

use DI\ContainerBuilder;
use Framework\Contracts\Config\Config;
use Framework\Engine\Application;
use Framework\Routing\Router;
use Framework\Views\Renderers\MustacheViewRenderer;
use Framework\Views\ViewRenderer;
use Symfony\Component\HttpFoundation\Request;

use function DI\factory;
use function DI\get;

require_once __DIR__.'/../vendor/autoload.php';

$container = (new ContainerBuilder)->build();

$app = new Application(__DIR__.'/..', $container);

$app->register(\Framework\Config\ConfigApplicationProvider::class);

$app->setup();

dd($container->get(Config::class));

// bind a "singleton" in the container
$container->set(Request::class, Request::createFromGlobals());

// set an alias for a bound form the container
$container->set('request', get(Request::class));

$container->set(
    ViewRenderer::class,
    factory(function () {
        return new MustacheViewRenderer(
            new Mustache_Engine([
                    'loader' => new Mustache_Loader_FilesystemLoader(__DIR__.'/../resources/views/'),
                ]
            )
        );
    }),
);

$container->set('view', get(ViewRenderer::class));

$router = new Router($container);
$router->setNamespace('App\\Http\\Controllers\\');
$router->get('demo', 'HomeController@showDemo');
$router->run();

