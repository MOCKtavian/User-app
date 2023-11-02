<?php

declare(strict_types=1);

namespace Framework\Http;

use Framework\Engine\ApplicationProvider;
use Symfony\Component\HttpFoundation\Request;

use function DI\get;

class HttpApplicationProvider extends ApplicationProvider
{
    public function load(): void
    {
        // bind a "singleton" in the container
        $this->container->set(Request::class, Request::createFromGlobals());

        // set an alias for a bound form the container
        $this->container->set('request', get(Request::class));
    }

    public function boot(): void
    {
        // ...
    }
}
