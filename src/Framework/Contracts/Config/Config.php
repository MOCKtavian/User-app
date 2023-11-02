<?php

declare(strict_types=1);

namespace Framework\Contracts\Config;

interface Config
{
    public function get(string $key, mixed $default = null): mixed;

    public function set(string $key, mixed $value): void;
}
