<?php

namespace App\Http\Controllers;

class HomeController
{
    public function getHome(): void
    {
        echo view('pages/home.mustache');
    }
}
