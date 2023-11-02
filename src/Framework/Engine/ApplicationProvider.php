<?php

declare(strict_types=1);

namespace Framework\Engine;

use DI\Container;
use Framework\Contracts\Engine\FrameworkProvider;

abstract class ApplicationProvider implements FrameworkProvider
{
    public function __construct(
        protected Container $container,
    ) {
    }
}
