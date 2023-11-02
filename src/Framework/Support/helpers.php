<?php

use DI\Container;
use Framework\Contracts\Config\Config;
use Framework\Engine\Application;
use Framework\Views\ViewRenderer;
use Symfony\Component\HttpFoundation\Request;

if (!function_exists('container')) {
    function container(): Container
    {
        return Application::container();
    }
}

if (!function_exists('config')) {
    /** @return Config|mixed */
    function config(string $key = null, mixed $default = null): mixed
    {
        /** @var Config $config */
        $config = container()->get('config');

        return $key !== null ? $config->get($key, $default) : $config;
    }
}

if (!function_exists('request')) {
    function request(): Request
    {
        return container()->get('request');
    }
}

if (!function_exists('view')) {
    function view(mixed $template = null, mixed $context = []): ViewRenderer|string
    {
        /** @var ViewRenderer $view */
        $view = container()->get('view');

        return $template !== null ? $view->render($template, $context) : $view;
    }
}
