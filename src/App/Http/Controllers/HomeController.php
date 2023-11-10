<?php

namespace App\Http\Controllers;

class HomeController
{
    public function __invoke()
    {
        echo view('pages/home.mustache', ['name' => 'Andi']);
    }

    public function giveLogin()
    {
        echo view('pages/home.mustache', ['name' => 'asdsa']);
    }
}
