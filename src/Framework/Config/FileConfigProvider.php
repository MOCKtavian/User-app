<?php

declare(strict_types=1);

namespace Framework\Config;

use Framework\Contracts\Config\ConfigProvider;

class FileConfigProvider implements ConfigProvider
{
    private string $directory;

    public function __construct(string $directory)
    {
        $this->directory = rtrim($directory, DIRECTORY_SEPARATOR);

        dump($this->directory);
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
        return glob($this->directory.DIRECTORY_SEPARATOR.'*.php');
    }

    private function key(string $file): string
    {
        return basename($file, '.php');
    }

    private function items(string $file): array
    {
        return require_once $file;
    }
}
