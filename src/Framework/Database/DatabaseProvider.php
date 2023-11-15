<?php

namespace Framework\Database;

use Framework\Engine\ApplicationProvider;

class DatabaseProvider extends ApplicationProvider
{

    public function load(): void
    {
        $this->container->set(
            Database::class,
            \DI\factory(function () {
                return (new Database())->getPdo();
            })
        );
    }

    public function boot(): void
    {
        //...
    }
}