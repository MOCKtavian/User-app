<?php

use App\Http\Controllers\HomeController;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ .  "/../routes/web.php";

//$framework->init();
$builder = new \DI\ContainerBuilder();
$container = $builder->build();

$container->set('request', Request::createFromGlobals());
$container->set('controller', new HomeController($container->get('request')));
$container->set(('mustacheEngine'), new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(getcwd(). '\\..\\resources\\views\\')
)));
//$template = $m->loadTemplate("\\pages\\home.mustache");
//echo $m->render("\\pages\\home.mustache", );

$router = new \Bootstrap\Routing\Router($container);
$router->setNamespace('App\\Http\\Controllers\\');
$router->get('demo', $container->call('controller::showDemo'));
$router->run();

