<?php

namespace Rogue\AreaCalculator\Area\Application\Handlers;

use Rogue\AreaCalculator\Area\Application\DTOs\CalculateAreaDTO;
use Rogue\AreaCalculator\Area\Application\Repositories\AreaRepository;
use Rogue\AreaCalculator\Area\Application\Services\Calculations\TrapezoidalMethodCalculator;

class CalculateAreaHandler
{
    private CalculateAreaDTO $dto;
    private AreaRepository $areaRepository;
    private TrapezoidalMethodCalculator $trapezoidCalculator;

    public function __construct(CalculateAreaDTO $dto)
    {
        $this->dto = $dto;
        $this->areaRepository = new AreaRepository();
        $this->trapezoidCalculator = new TrapezoidalMethodCalculator($this->dto->getN());
    }

    public function calculate(): array
    {
        $areaCalculation = $this->trapezoidCalculator->trapezoidal();
        $area = $this->areaRepository->createArea($this->dto->getId(), $areaCalculation);

        return [
            'id' => $area->getId(),
            'area' => $area->getArea()
        ];
    }
}
