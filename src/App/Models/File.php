<?php

namespace Models;

class File
{

    public function __construct(
        private string $path
    ) {
    }

    public function getPath() : string
    {
        return $this->path;
    }
}