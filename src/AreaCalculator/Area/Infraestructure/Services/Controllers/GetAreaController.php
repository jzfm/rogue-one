<?php

namespace Rogue\AreaCalculator\Area\Infraestructure\Services\Controllers;

use Rogue\AreaCalculator\Area\Application\DTOs\GetAreaDTO;
use Rogue\AreaCalculator\Area\Application\Handlers\GetAreaHandler;

class GetAreaController
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getAreaAndWeatherById(): array
    {
        $dto = new GetAreaDTO(
            $this->id
        );

        $handler = new GetAreaHandler($dto);

        return $handler->getAreaAndTomorrowWeatherById();
    }
}
