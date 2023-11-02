<?php

declare(strict_types=1);

namespace Framework\Routing;

use Framework\Engine\ApplicationProvider;

use function DI\get;

class RoutingApplicationProvider extends ApplicationProvider
{
    public function load(): void
    {
        $this->container->set(
            Router::class,
            \DI\factory(function () {
                $router = new Router($this->container);

                $router->setNamespace('App\\Http\\Controllers\\');

                return $router;
            }),
        );

        $this->container->set('router', get(Router::class));
    }

    public function boot(): void
    {
        // ...
    }
}
