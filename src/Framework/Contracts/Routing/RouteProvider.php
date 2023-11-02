<?php

declare(strict_types=1);

namespace Framework\Contracts\Routing;

interface RouteProvider
{
    public function get(): array;
}
