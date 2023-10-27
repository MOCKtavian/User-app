<?php

use App\Http\Controllers\HomeController;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ .  "/../routes/web.php";

//$framework->init();
$builder = new \DI\ContainerBuilder();
$container = $builder->build();

$container->set('request', Request::createFromGlobals());
//$container->set(\Bootstrap\Contracts\Storage\Storage::class, new class implements \Bootstrap\Contracts\Storage\Storage {
//    public function get(): string
//    {
//        return 'demo';
//    }
//});
$controller= $container->get(HomeController::class);
//$container->call([$controller, 'showDemo']);



$m = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'\\..\\resources\\views'),
));

//$template = $m->loadTemplate("\\pages\\home.mustache");
//echo $m->render("\\pages\\home.mustache", ['user' => \Symfony\Component\Uid\Ulid::generate(), 'name' => 'user']);

$router = new \Bootstrap\Routing\Router($container);

$router->get('demo', 'HomeController@showDemo');

$router->run();



