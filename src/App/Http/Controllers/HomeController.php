<?php

namespace App\Http\Controllers;

use Framework\Views\ViewRenderer;

class HomeController extends Controller
{
    public function __construct(
        private ViewRenderer $view
    ) {
    }

    public function showDemo()
    {
        dd($this->view->render
        ('\\pages\\home.mustache',
            ['user' => \Symfony\Component\Uid\Ulid::generate(),
                'name' => 'user']
        ));
    }
}