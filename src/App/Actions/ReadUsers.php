<?php

namespace App\Actions;

use App\Contracts\UserRepository;
use App\Entities\User;
class ReadUsers
{
    public function __construct(
        private UserRepository $repository,
    ) {
    }

    public function fetchAction(string $id): User
    {
        return $this->repository->get($id);
    }

    public function fetchAllAction()
    {
        return $this->repository->all();
    }
}