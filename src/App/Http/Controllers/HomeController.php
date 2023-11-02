<?php

namespace App\Http\Controllers;

class HomeController
{
    public function __invoke(): void
    {
        echo view('home', ['name' => 'Andi']);
    }
}
