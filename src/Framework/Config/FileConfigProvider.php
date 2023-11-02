<?php

declare(strict_types=1);

namespace Framework\Config;

use Framework\Contracts\Config\ConfigProvider;

class FileConfigProvider implements ConfigProvider
{
    public function __construct(
        private string $directory,
    ) {
    }

    public function get(): array
    {
        $items = [];

        foreach ($this->files() as $file) {
            $items[$this->key($file)] = $this->items($file);
        }

        return $items;
    }

    private function files(): array
    {
        return glob($this->directory.'/*.php');
    }

    private function key(string $file): string
    {
        return basename($file, '.php');
    }

    private function items(string $file): array
    {
        require_once $file;
    }
}
