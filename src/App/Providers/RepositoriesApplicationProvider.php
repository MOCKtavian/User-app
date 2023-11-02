<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\UserRepository;
use App\Repositories\UserDatabaseRepository;
use Framework\Engine\ApplicationProvider;

use function DI\create;

class RepositoriesApplicationProvider extends ApplicationProvider
{
    public function load(): void
    {
        $this->container->set(UserRepository::class, create(UserDatabaseRepository::class));
    }

    public function boot(): void
    {
        // ...
    }
}
