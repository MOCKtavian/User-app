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
    ) {
    }

    public function create(UserData $data): User
    {
        return User::create($this->insert($data), $data);
    }

    private function insert(UserData $data): int
    {
        $newData = [
            'email' => $data->email,
            'nume' => $data->nume,
        ];
        $stmt = $this->databasePDO->getPDO()
            ->prepare("INSERT INTO `users` (`email`, `nume`) VALUES (:email, :nume)");
        $stmt->execute($newData);
        dd($this->findWhereEmail($data->email)->id());
        return $this->findWhereEmail($data->email)->id();
    }

    public function get(int $id): User
    {
        return $this->find($id) ?? throw EntityNotFoundException::missing(User::class, $id);
    }

    public function find(int $id): User
    {
        $fetch = $this->databasePDO->fetch('users', $id);
        return new User(
            $fetch['id'],
            $fetch['nume'],
            $fetch['email']
        );
    }

    public function findWhereEmail(string $email): ?User
    {
        $data = [
            'email' => $email,
        ];
        $stmt = $this->databasePDO->getPDO()
            ->prepare("SELECT * FROM `users` WHERE email = :email ");
        $stmt->execute($data);

        $fetch = ($stmt->fetchAll(PDO::FETCH_ASSOC));
        if(empty($fetch)){
            return null;
        }

        return new User(
            $fetch[0]['id'],
            $fetch[0]['nume'],
            $fetch[0]['email']
        );
    }

    public function update(User $user): void
    {
        // ...
    }
}
