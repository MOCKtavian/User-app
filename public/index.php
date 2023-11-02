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

$app = Application::create(__DIR__.DIRECTORY_SEPARATOR.'..', $container);

$app->register(\Framework\Config\ConfigApplicationProvider::class);
$app->register(\Framework\Http\HttpApplicationProvider::class);
$app->register(\Framework\Routing\RoutingApplicationProvider::class);
$app->register(\Framework\Views\ViewsApplicationProvider::class);

foreach (config('app.providers', []) as $provider) {
    $app->register($provider);
}

$app->setup();

//dd(
//    $container->get('config'),
//    $container->get('request'),
//    $container->get('router'),
//    $container->get('view'),
//);

$app->run();

