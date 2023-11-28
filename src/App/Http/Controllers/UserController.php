<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Actions\ReadUsers;
use App\Contracts\UserRepository;
use App\Data\UserData;
use Symfony\Component\HttpFoundation\Request;

class UserController
{

    public function create(Request $request, CreateUser $action): void
    {
        $action->execute(
            new UserData(
                $request->request->get('email'),
                $request->request->get('nume'),
            ),
        );
    }

    public function showUsers(ReadUsers $action)
    {
        dump($action->fetchAllAction());
    }

    public function fetchUser(string $id,Request $request, ReadUsers $action)
    {
        print_r($action->fetchAction($id));
    }

    public function deleteUser(int $id, UserRepository $repository)
    {
        $repository->delete($id);
    }
}
