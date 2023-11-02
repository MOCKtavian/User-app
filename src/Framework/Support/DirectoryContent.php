<?php

declare(strict_types=1);

namespace Framework\Support;

class DirectoryContent
{
    private string $directory;

    public static function parse(string $directory): array
    {
        return (new static($directory))->get();
    }

    public function __construct(string $directory)
    {
        $this->directory = rtrim($directory, DIRECTORY_SEPARATOR);
    }

    public function get(): array
    {
        $items = [];

        foreach ($this->files() as $file) {
            $items[$this->key($file)] = $this->content($file);
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

    private function content(string $file): mixed
    {
        return require_once $file;
    }
}
