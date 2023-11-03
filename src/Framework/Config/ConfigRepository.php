<?php

declare(strict_types=1);

namespace Framework\Config;

use Framework\Contracts\Config\Config;

class ConfigRepository implements Config
{
    public function __construct(
        public array $items,
    ) {
    }

    public function get(string $key, mixed $default = null): mixed
    {
        // @todo

        return $this->default($default);
    }

    private function default(mixed $default): mixed
    {
        return is_callable($default) ? $default() : $default;
    }
}
