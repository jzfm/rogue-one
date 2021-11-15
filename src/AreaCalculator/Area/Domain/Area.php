<?php

namespace Rogue\AreaCalculator\Area\Domain;

class Area
{
    private string $id;
    private float $area;

    public function __construct(
        string $id,
        float $area
    ) {
        $this->id = $id;
        $this->area = $area;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getArea(): float
    {
        return $this->area;
    }
}
