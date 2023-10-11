<?php

namespace Contracts;

use Models\User;

interface UserRepository
{
    public function add(User $user): void;

    public function find(int $id): User;
}