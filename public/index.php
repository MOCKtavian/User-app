<?php

use App\Contracts\UserRepository;
use DI\ContainerBuilder;
use Framework\Engine\Application;

require_once __DIR__.'/../vendor/autoload.php';

$container = (new ContainerBuilder)->build();

$app = Application::create(__DIR__.DIRECTORY_SEPARATOR.'..', $container);
$app->bootstrap(
    \Framework\Engine\Bootstrap\LoadConfig::class,
    \Framework\Engine\Bootstrap\RegisterProviders::class,
    \Framework\Engine\Bootstrap\SetupApplication::class,
);

//dd(
//    $container->get('config'),
//    $container->get('request'),
//    $container->get('router'),
//    $container->get('view'),
//    $container->get(UserRepository::class),
//);

$app->run();
