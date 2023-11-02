<?php

declare(strict_types=1);

namespace Framework\Config;

use Framework\Contracts\Config\Config;
use Framework\Contracts\Config\ConfigProvider;
use Framework\Engine\ApplicationProvider;
use Psr\Container\ContainerInterface;

use function DI\factory;
use function DI\get;

class ConfigApplicationProvider extends ApplicationProvider
{
    public function load(): void
    {
        $this->setConfigProvider();
        $this->setConfig();
        $this->setConfigAlias();
    }

    private function setConfigProvider(): void
    {
        $this->container->set(
            ConfigProvider::class,
            factory(function (ContainerInterface $container) {
                return new FileConfigProvider(
                    $container->get('base_path').DIRECTORY_SEPARATOR.'config',
                );
            }),
        );
    }

    private function setConfig(): void
    {
        $this->container->set(
            Config::class,
            factory(function (ContainerInterface $container) {
                /** @var ConfigProvider $provider */
                $provider = $container->get(ConfigProvider::class);

                return new ConfigRepository($provider->get());
            }),
        );
    }

    private function setConfigAlias(): void
    {
        $this->container->set('config', get(Config::class));
    }

    public function boot(): void
    {
        // ...
    }
}
