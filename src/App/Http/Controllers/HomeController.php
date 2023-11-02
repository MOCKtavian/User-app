<?php

namespace App\Http\Controllers;

class HomeController
{
    public function __invoke(): string
    {
        return view('home', ['name' => 'Andi']);
    }
}
