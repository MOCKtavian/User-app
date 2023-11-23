<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\UserRepository;
use App\Repositories\UserDatabaseRepository;
use Framework\Database\DatabasePDO;
use Framework\Engine\ApplicationProvider;

use function DI\create;

class RepositoriesApplicationProvider extends ApplicationProvider
{
    public function load(): void
    {


    }

    public function boot(): void
    {
        $this->container->set(UserRepository::class,
            \DI\factory(function() {
                $userDatabaseRepository = new UserDatabaseRepository($this->container->get(DatabasePDO::class));
                return $userDatabaseRepository;
            })
        );
    }
}
