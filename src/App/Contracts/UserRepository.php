<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Data\UserData;
use App\Entities\User;

interface UserRepository
{
    public function create(UserData $data): User;

    public function get(int $id): User;

    public function find(int $id): User;

    public function findWhereEmail(string $email): ?User;

    public function update(User $user): void;
}
