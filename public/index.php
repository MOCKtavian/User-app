<?php

use App\Http\Controllers\HomeController;
use Framework\Views\Renderers\MustacheViewRenderer;
use Framework\Views\ViewRenderer;
use Symfony\Component\HttpFoundation\Request;

use function DI\create;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ .  "/../routes/web.php";

//$framework->init();

$builder = new \DI\ContainerBuilder();
$container = $builder->build();
$container->set(\App\Http\Controllers\Controller::class, create(HomeController::class));
$container->set(Request::class, Request::createFromGlobals()); // alias request
$m = new Mustache_Engine();
$container->set(ViewRenderer::class, new MustacheViewRenderer(new Mustache_Engine([
    'loader' => new Mustache_Loader_FilesystemLoader(getcwd(). '\\..\\resources\\views\\')
])));

$router = new \Framework\Routing\Router($container);
$router->setNamespace('App\\Http\\Controllers\\');
$router->get('demo', 'HomeController@showDemo');
$router->run();

