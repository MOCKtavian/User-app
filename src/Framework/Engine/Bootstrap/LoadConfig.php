<?php

declare(strict_types=1);

namespace Framework\Engine\Bootstrap;

use Framework\Config\ConfigRepository;
use Framework\Contracts\Config\Config;
use Framework\Contracts\Engine\FrameworkBootstrapper;
use Framework\Engine\Application;
use Framework\Support\DirectoryContent;
use Psr\Container\ContainerInterface;

use function DI\factory;
use function DI\get;

class LoadConfig implements FrameworkBootstrapper
{
    public function bootstrap(Application $app): void
    {
        $app->container->set(
            Config::class,
            factory(function (ContainerInterface $container) {
                return new ConfigRepository(
                    DirectoryContent::parse(
                        $container->get('base_path').DIRECTORY_SEPARATOR.'config',
                    )
                );
            }),
        );

        $app->container->set('config', get(Config::class));
    }
}
