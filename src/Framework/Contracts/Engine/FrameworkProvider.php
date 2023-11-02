<?php

declare(strict_types=1);

namespace Framework\Contracts\Engine;

interface FrameworkProvider
{
    public function load(): void;

    public function boot(): void;
}
