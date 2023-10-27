<?php

namespace App\Http\Controllers;

use Bootstrap\Contracts\Storage\Storage;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function __construct(Request $request/**, public Storage $storage*/){

    }

    public function showDemo()
    {
//        return $this->storage->get();
        echo 'demo';
    }


}