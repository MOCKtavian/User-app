<?php

namespace Actions;

use App\Repositories\UserRepository;
use Entities\User;
use Symfony\Component\Uid\Ulid;
//DTO
class CreateUser
{
    public function __construct(UserRepository $userRepository)
    {

    }
    public function create(string $name): User
    {
        $uid = new Ulid();
        return new User((int)$uid, $name);
    }
}