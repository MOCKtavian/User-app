<?php

declare(strict_types=1);

namespace Framework\Contracts\Engine;

use Framework\Engine\Application;

interface FrameworkBootstrapper
{
    public function bootstrap(Application $app): void;
}
