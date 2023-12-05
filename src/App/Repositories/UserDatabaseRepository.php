<?php

namespace App\Repositories;

use App\Contracts\UserRepository;
use App\Data\UserData;
use App\Entities\User;
use App\Exceptions\EntityNotFoundException;
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

    public function all(): array
    {
        $stmt = $this->databasePDO->getPDO()->prepare('SELECT * FROM `users`');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function insert(UserData $data): int
    {
        $stmt = $this->databasePDO->getPDO()
            ->prepare('INSERT INTO `users` (`email`, `name`) VALUES (:email, :name)');

        $stmt->execute([
            'email' => $data->email,
            'name' => $data->name,
        ]);

        return $this->databasePDO->lastInsertID();
    }

    public function get(int $id): User
    {
        return $this->find($id) ?? throw EntityNotFoundException::missing(User::class, $id);
    }

    public function find(int $id): ?User
    {
        return $this->map($this->databasePDO->fetch('users', $id));
    }

    public function findWhereEmail(string $email): ?User
    {
        $stmt = $this->databasePDO->getPDO()
            ->prepare("SELECT * FROM `users` WHERE email = :email");

        $stmt->execute([
            'email' => $email,
        ]);

        return $this->map($stmt->fetchAll(PDO::FETCH_ASSOC)[0] ?? null);
    }

    public function update(int $id, UserData $data): void
    {
        $user = $this->get($id);
        $user->update($data);
        $stmt = $this->databasePDO->getPDO()
            ->prepare("UPDATE users SET (`name`, `email`) = (:name, :email) ");
        $stmt->execute([
            'name' => $data->name,
            'email' => $data->name,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->databasePDO->getPDO()
            ->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([
            'id' => $id
        ]);
    }

    private function map(?array $data): ?User
    {
        return $data ? User::create(
            $data['id'],
            new UserData($data['email'], $data['name'])
        ) : null;
    }
}
