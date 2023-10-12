<?php

namespace Entities;

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