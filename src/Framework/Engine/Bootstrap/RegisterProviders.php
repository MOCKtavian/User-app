<?php

declare(strict_types=1);

namespace Framework\Engine\Bootstrap;

use App\Providers\RepositoriesApplicationProvider;
use Framework\Contracts\Engine\FrameworkBootstrapper;
use Framework\Database\DatabaseProvider;
use Framework\Engine\Application;
use Framework\Http\HttpApplicationProvider;
use Framework\Routing\RoutingApplicationProvider;
use Framework\Views\ViewsApplicationProvider;

class RegisterProviders implements FrameworkBootstrapper
{
    private array $internal = [
        DatabaseProvider::class,
        HttpApplicationProvider::class,
        RoutingApplicationProvider::class,
        RepositoriesApplicationProvider::class,
        ViewsApplicationProvider::class,
    ];

    public function bootstrap(Application $app): void
    {
        foreach ($this->getProviders($app) as $provider) {
            $app->register($provider);
        }
    }

    private function getProviders(Application $app): array
    {
        return array_merge(
            $this->internal,
            $this->getProvidersFromConfig($app),
        );
    }

    private function getProvidersFromConfig(Application $app): array
    {
        return $app->container->get('config')->get('app.providers', []);
    }
}
