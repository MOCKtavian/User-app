<?php

namespace Actions;

use Models\File;
//DTO
class CreateUser
{
    public function create(string $name, File $file ): User
    {

        return $user;
    }
}