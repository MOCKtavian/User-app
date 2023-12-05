<?php

namespace Framework\Database;

use Framework\Engine\ApplicationProvider;


class DatabaseProvider extends ApplicationProvider
{

    public function load(): void
    {
        $this->container->set(
            DatabasePDO::class,
            \DI\factory(function () {
                return new DatabasePDO();
            })
        );
    }

    public function boot(): void
    {
        //...
    }
}