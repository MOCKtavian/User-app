<?php

namespace Contracts;

use Entities\User;

interface UserRepository
{
    public function add(User $user): void;

    public function find(int $id): User;
}