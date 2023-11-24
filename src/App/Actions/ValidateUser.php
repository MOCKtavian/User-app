<?php

namespace App\Actions;

use App\Contracts\UserRepository;
use App\Entities\User;

class ValidateUser
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

//    public function validate(UserData $data): User
//    {
//
//    }
}