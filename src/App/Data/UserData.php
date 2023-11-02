<?php

declare(strict_types=1);

namespace App\Data;

readonly class UserData
{
    public function __construct(
        public string $email,
        public string $name,
    ) {
    }
}
