<?php

declare(strict_types=1);

namespace Framework\Routing;

use Framework\Engine\ApplicationProvider;

use Framework\Support\DirectoryContent;

use function DI\get;

class RoutingApplicationProvider extends ApplicationProvider
{
    public function load(): void
    {
        $this->container->set(
            Router::class,
            \DI\factory(function () {
                $router = new Router($this->container);
                return $router;
            }),
        );

        $this->container->set('router', get(Router::class));
    }

    public function boot(): void
    {
        $router = $this->container->get('router');

        foreach ($this->getRouteCallbacks() as $callback) {
            $callback($router);
        }
    }

    private function getRouteCallbacks(): array
    {
        return DirectoryContent::parse(
            $this->container->get('base_path').DIRECTORY_SEPARATOR.'routes',
        );
    }
}
