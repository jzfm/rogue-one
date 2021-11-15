<?php

namespace Rogue\Shared\Infraestructure\Exceptions;

use RuntimeException;

class PersistanceException extends RuntimeException
{
    public function __construct(string $message, $code = 422)
    {
        parent::__construct($message, $code);
    }

    public static function notFound(string $id): self
    {
        return new static('Entity with id ' . $id . ' not found');
    }

    public static function notSaved(string $id): self
    {
        return new static('Error creating entity with id "' . $id . '". Please, retry later');
    }

    public static function alreadyExist(string $id): self
    {
        return new static('Entity with id: ' . $id . ' already exist.');
    }
}
