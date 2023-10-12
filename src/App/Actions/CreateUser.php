<?php

namespace Actions;

use Entities\User;
use Symfony\Component\Uid\Ulid;
//DTO
class CreateUser
{
    public function create(string $name): User
    {
        $ulid = new Ulid();
        return new User((int)$ulid, $name);
    }
}