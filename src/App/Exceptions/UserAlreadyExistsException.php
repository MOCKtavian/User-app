<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

class UserAlreadyExistsException extends RuntimeException
{
    protected string $email;

    public static function exists(string $email): static
    {
        return (new static('A user with the given email address already exists.'))
            ->setEmail($email);
    }

    protected function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
