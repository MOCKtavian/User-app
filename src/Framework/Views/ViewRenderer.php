<?php

namespace Framework\Views;

interface ViewRenderer
{
    public function render(mixed $template, mixed $context = []): string;
}
