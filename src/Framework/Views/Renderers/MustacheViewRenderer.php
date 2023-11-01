<?php

namespace Framework\Views\Renderers;

use Framework\Views\ViewRenderer;
use Mustache_Engine;

class MustacheViewRenderer implements ViewRenderer
{
    public function __construct(
        private Mustache_Engine $engine
    ) {
    }

    public function render(mixed $template, mixed $context): string
    {
        return $this->engine->render($template, $context);
    }
}