<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Data\UserData;
use App\Entities\User;

interface UserRepository
{
    public function create(UserData $data): User;

    public function get(int $id);

    public function find(int $id);

    public function findWhereEmail(string $email);

    public function update(User $user): void;
}
