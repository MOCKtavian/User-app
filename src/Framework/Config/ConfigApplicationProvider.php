<?php

declare(strict_types=1);

namespace Framework\Config;

use Framework\Contracts\Config\Config;
use Framework\Engine\ApplicationProvider;
use Framework\Support\DirectoryContent;
use Psr\Container\ContainerInterface;

use function DI\factory;
use function DI\get;

class ConfigApplicationProvider extends ApplicationProvider
{
    public function load(): void
    {
        $this->container->set(
            Config::class,
            factory(function (ContainerInterface $container) {
                return new ConfigRepository(
                    DirectoryContent::parse(
                        $container->get('base_path').DIRECTORY_SEPARATOR.'config',
                    )
                );
            }),
        );

        $this->container->set('config', get(Config::class));
    }

    public function boot(): void
    {
        // ...
    }
}
