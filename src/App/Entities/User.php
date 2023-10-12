<?php

namespace Entities;

class User
{
    public function __construct(
        private int $id,
        private string $name
    ) {
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}