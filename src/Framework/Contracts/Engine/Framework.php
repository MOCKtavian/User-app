<?php

namespace Framework\Contracts\Engine;

interface Framework
{
    public function register(string $provider): static;

    public function setup(): void;
}
