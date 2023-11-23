<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateUser;
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

    public function get($id, Request $request)
    {
        dump($request, $id);

    }
}
