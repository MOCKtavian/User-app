<?php

namespace App\Entities;

use App\Data\UserData;

class User
{
    public static function create(int $id, UserData $data): static
    {
        return new static(
            id: $id,
            email: $data->email,
            name: $data->name
        );
    }

    public function __construct(
        private readonly int $id,
        private string $email,
        private string $name,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function name(): string
    {
        return $this->name;
    }
}
