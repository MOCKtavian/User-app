<?php

declare(strict_types=1);

namespace Framework\Contracts\Config;

interface ConfigProvider
{
    public function get(): array;
}
