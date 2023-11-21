<?php

namespace App\Http\Controllers;

class HomeController
{
    public function __invoke()
    {
        echo view('pages/home.mustache', ['name' => 'Andi']);
    }

    public function getHome()
    {
        echo view('pages/home.mustache', ['name' => 'asdsa', 'title' => 'register']);
    }
}
