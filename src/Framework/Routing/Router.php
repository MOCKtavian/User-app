<?php

namespace Bootstrap\Routing;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Bootstrap\Exceptions\UnresolvableControllerException;
use Bootstrap\Exceptions\UnresolvableRequestException;
use Closure;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use RuntimeException;

class Router extends \Bramus\Router\Router
{
    public function __construct(
        private ContainerInterface $container,
    ) {
    }

    private function invoke($fn, $params): void
    {
        if ($fn instanceof Closure) {
            $this->callRouteCallback($fn, $params);
        } elseif ($this->isControllerClass($fn)) {
            $this->callController($fn, $params);
        } elseif ($this->isControllerCallback($fn)) {
            $this->callControllerCallback($fn, $params);
        } else {
            throw new RuntimeException('Unmatched route');
        }
    }

    private function isControllerClass(mixed $class): bool
    {
        return is_string($class) && class_exists($class) && is_callable($class);
    }

    private function isControllerCallback(mixed $callback): bool
    {
        return is_string($callback) && str_contains($callback, '@');
    }

    private function callController(string $controller, array $parameters): void
    {
        $this->callControllerMethod($controller, '__invoke', $parameters);
    }

    private function callControllerCallback(string $callback, array $parameters): void
    {
        [$controller, $method] = $this->parseControllerCallback($callback);

        $this->callControllerMethod($controller, $method, $parameters);
    }

    private function parseControllerCallback(string $callback): array
    {
        [$controller, $method] = explode('@', $callback, 2);

        if ($this->getNamespace() !== '') {
            $controller = $this->getNamespace() . '\\' . ltrim($controller, '\\');
        }

        return [$controller, $method];
    }

    private function callControllerMethod(string $controller, string $method, array $parameters): void
    {
        if (!class_exists($controller)) {
            throw new RuntimeException("Controller class `{$controller}` does not exist.");
        }

        if (!method_exists($method, $controller)) {
            throw new RuntimeException("Controller class `{$controller}` does not have the method `{$method}`.");
        }

        $controller = $this->makeControllerInstance($controller);

        $this->callRouteCallback([$controller, $method], $parameters);
    }

    private function makeControllerInstance(string $controller): object
    {
        try {
            return $this->container->get($controller);
        } catch (ContainerExceptionInterface $exception) {
            throw UnresolvableControllerException::unbound($controller, $exception);
        }
    }

    private function callRouteCallback(callable $callable, array $parameters): void
    {
        $callable([$this->getRequest(), ...$parameters]);
    }

    private function getRequest(): object
    {
        try{
            return $this->container->get('request');
        } catch (ContainerExceptionInterface $exception) {
            throw UnresolvableRequestException::unbound($exception);
        }
    }
}
