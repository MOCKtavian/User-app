<?php

namespace Framework\Exceptions;

use Throwable;

class UnresolvableRequestException extends \RuntimeException
{
    public static function unbound(Throwable $previous = null): static
    {
        return new static('Request class is not bound in the container.', previous: $previous);
    }
}