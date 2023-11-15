<?php

declare(strict_types=1);

namespace Framework\Engine\Bootstrap;

use Framework\Contracts\Engine\FrameworkBootstrapper;
use Framework\Engine\Application;

class SetupApplication implements FrameworkBootstrapper
{
    public function bootstrap(Application $app): void
    {
        $app->setup();
    }
}
