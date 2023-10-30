<?php

namespace App\Http\Controllers;

use Bootstrap\Contracts\Storage\Storage;
use DI\Container;
use Mustache_Engine;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function __construct(Request $request/**, public Storage $storage*/){

    }

    public function showDemo(Container $container)
    {
//        return $this->storage->get();
        echo $container->call('mustacheEngine::render', ['\\pages\\home.mustache',  ['user' => \Symfony\Component\Uid\Ulid::generate(), 'name' => 'user']]);
//        $tpl = $m->loadTemplate('pages\\home.mustache');
    }



}