<?php

namespace App\Repositories;

use App\Contracts\UserRepository;
use App\Data\UserData;
use App\Entities\User;
use App\Exceptions\EntityNotFoundException;

class UserDatabaseRepository implements UserRepository
{
    public function create(UserData $data): User
    {
        return User::create($this->insert($data), $data);
    }

    private function insert(UserData $data): int
    {
        // insert and return the id
        return 1;
    }

    public function get(int $id): User
    {
        return $this->find($id) ?? throw EntityNotFoundException::missing(User::class, $id);
    }

    public function find(int $id): ?User
    {
        // TODO: Implement find() method.
    }

    public function findWhereEmail(string $email): ?User
    {
        // TODO: Implement findWhereEmail() method.
    }

    public function update(User $user): void
    {
        // ...
    }
}
