<?php

namespace Providers;

use App\Http\Controllers\Controller;
use http\Env\Request;

class Container
{
    public function __construct(
        public Request $request,
        public Controller $controller
    ){
    }


    public function make($controller)
    {
        $this->controller = new Controller();
    }
}