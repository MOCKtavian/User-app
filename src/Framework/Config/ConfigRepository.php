<?php

declare(strict_types=1);

namespace Framework\Config;

use Framework\Contracts\Config\Config;

class ConfigRepository implements Config
{
    public function get(string $key, mixed $default = null): mixed
    {
        // TODO: Implement get() method.
    }

    public function set(string $key, mixed $value): void
    {
        // TODO: Implement set() method.
    }
}
