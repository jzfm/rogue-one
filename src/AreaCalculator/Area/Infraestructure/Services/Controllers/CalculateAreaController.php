<?php

namespace Rogue\AreaCalculator\Area\Infraestructure\Services\Controllers;

use App\Http\Requests\CalculateAreaRequest;
use Rogue\AreaCalculator\Area\Application\DTOs\CalculateAreaDTO;
use Rogue\AreaCalculator\Area\Application\Handlers\CalculateAreaHandler;

class CalculateAreaController
{
    private CalculateAreaRequest $request;

    public function __construct(CalculateAreaRequest $request)
    {
        $this->request = $request;
    }

    public function calculate(): array
    {
        $dto = new CalculateAreaDTO(
            $this->request->input('uuid'),
            $this->request->input('n')
        );

        $handler = new CalculateAreaHandler($dto);

        return $handler->calculate();
    }
}
