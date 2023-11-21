<?php

namespace App\Repositories;

use App\Contracts\UserRepository;
use App\Data\UserData;
use App\Entities\User;
use App\Exceptions\EntityNotFoundException;
use Framework\Database\Database;
use Framework\Database\DatabasePDO;
use PDO;

class UserDatabaseRepository implements UserRepository
{
    public function __construct(
        public DatabasePDO $databasePDO
    ){}
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
        return $this->databasePDO->fetch('users', '$id');
    }

    public function findWhereEmail(string $email): ?User
    {
         $stmt = $this->databasePDO->$this->pdo->prepare("SELECT FROM users WHERE email = $email");
         return $stmt->execute();
    }

    public function update(User $user): void
    {
        // ...
    }
}
