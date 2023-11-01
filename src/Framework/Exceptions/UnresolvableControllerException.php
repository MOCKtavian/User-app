<?php

namespace Framework\Exceptions;

use RuntimeException;
use Throwable;

class UnresolvableControllerException extends RuntimeException
{
    protected string $controller;

    public static function unbound(string $controller, Throwable $previous = null): static
    {
        return (
            new static('Controller class is not bound in the container.', previous: $previous)
        )->setController($controller);

    }

    protected function setController(string $controller): static
    {
        $this->controller = $controller;

        return $this;
    }

    public function getController(): string
    {
        return $this->controller;
    }
}