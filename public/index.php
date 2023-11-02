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

$app = new Application(__DIR__.DIRECTORY_SEPARATOR.'..', $container);

$app->register(\Framework\Config\ConfigApplicationProvider::class);
$app->register(\Framework\Views\ViewsApplicationProvider::class);
$app->register(\Framework\Http\HttpApplicationProvider::class);

$app->setup();

dd(
    $container->get('config'),
    $container->get('view'),
    $container->get('request'),
);

$router = new Router($container);
$router->setNamespace('App\\Http\\Controllers\\');
$router->get('demo', 'HomeController@showDemo');
$router->run();

