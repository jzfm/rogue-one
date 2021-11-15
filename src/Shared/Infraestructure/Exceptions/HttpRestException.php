<?php

namespace Rogue\Shared\Infraestructure\Exceptions;

use RuntimeException;

class HttpRestException extends RuntimeException
{
    public function __construct(string $message, $code = 422)
    {
        parent::__construct($message, $code);
    }

    public static function cannotConnect(): self
    {
        return new static('Cannot connect with external services right now. Try again later');
    }
}
