<?php

namespace App\Actions;

use App\Contracts\UserRepository;
use App\Data\UserData;
use App\Entities\User;
use App\Exceptions\UserAlreadyExistsException;

class CreateUser
{
    public function __construct(
        protected UserRepository $repository,
    ) {
    }

    public function execute(UserData $data): User
    {
        if ($this->repository->findWhereEmail($data->email)) {
            throw UserAlreadyExistsException::exists($data->email);
        }

        return $this->repository->create($data);
    }
}
