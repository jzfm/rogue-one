<?php

namespace Rogue\Shared\Infraestructure\Response;

use Rogue\Shared\Infraestructure\Response\Response;

interface ResponseBuilderInterface
{
    public function make(Response $result);
    public function setResult(Response $result);
    public function setKeyData(string $keyData);
}
