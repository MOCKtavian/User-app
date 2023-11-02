<?php

namespace Framework\Engine;

use DI\Container;
use Framework\Contracts\Engine\FrameworkProvider;
use InvalidArgumentException;

class Application
{
    private array $providers = [];

    private Container $container;

    private static Application $instance;

    public static function create(string $basePath, Container $container): static
    {
        static::$instance = new static($basePath, $container);

        return static::$instance;
    }

    public static function container(): Container
    {
        return static::$instance->container;
    }

    public function __construct(string $basePath, Container $container)
    {
        $container->set('base_path', rtrim($basePath, DIRECTORY_SEPARATOR));

        $this->container = $container;
    }

    public function register(string $provider): static
    {
        if (!is_a($provider, FrameworkProvider::class, true)) {
            throw new InvalidArgumentException("The class `{$provider}` is not a framework provider.");
        }

        $this->providers[] = new $provider($this->container);

        return $this;
    }

    public function setup(): void
    {
        $this->setupProviders($this->load(...));
        $this->setupProviders($this->boot(...));
    }

    private function setupProviders(callable $callback): void
    {
        foreach ($this->providers as $provider) {
            $callback($provider);
        }
    }

    private function load(FrameworkProvider $provider): void
    {
        $provider->load();
    }

    private function boot(FrameworkProvider $provider): void
    {
        $provider->boot();
    }

    public function run(): void
    {
        $this->container->get('router')->run();
    }
}
