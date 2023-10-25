<?php

namespace App\Http\Controllers;
use Bootstrap\Providers\Container;

class HomeController extends Controller
{
    public function __construct(
    )
    {

    }

    public function showDad()
    {
        echo "i am here";
    }


}