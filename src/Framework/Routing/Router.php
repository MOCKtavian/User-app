<?php

namespace Bootstrap\Routing;
use App\Http\Controllers\Controller;
use Providers\Container;
use Closure;
use RuntimeException;

class Router extends \Bramus\Router\Router
{
    public function __construct(
        private $container,
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
        return $this->container->make($controller);
    }

    private function callRouteCallback(callable $callable, array $parameters): void
    {
        $this->container->call($callable, $parameters);

        // editUser(Request $request, int $id)

        // $request: from container
        // $id: from $parameters[0]
    }
}

//class Router extends \Bramus\Router\Router
//{
//    public Container $container;
//    private function invoke($fn, $params = array())
//    {
//        if (is_callable($fn)) {
//            call_user_func_array($fn, $params);
//        } // If not, check the existence of special parameters
//        elseif (stripos($fn, '@') !== false) {
//            // Explode segments of given route
//            list($controller, $method) = explode('@', $fn);
//            // Adjust controller class if namespace has been set
//            $this->adjustControllerName($controller);
//        }
//        // Make sure it's callable
//       $this->isCallable($controller, $method, $params);
//    }
//    public function adjustControllerName($controller) : void
//    {
//        if (Router::class->getNamespace() !== '') {
//            $controller = Router::class->getNamespace() . '\\' . $controller;
//        }
//    }
//    public function isCallable($controller, $method, $params) : void
//    {
//        $reflectedMethod = new \ReflectionMethod($controller, $method);
//        if ($reflectedMethod->isPublic() && (!$reflectedMethod->isAbstract())) {
//            if ($reflectedMethod->isStatic()) {
//                forward_static_call_array(array($controller, $method), $params);
//            }
//        }
//    }
//    public static function instantiate(Controller $controller) : void
//    {
//        $this->container->make($controller);
//    }
//}