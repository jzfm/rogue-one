<?php

namespace Rogue\AreaCalculator\Area\Application\DTOs;

class CalculateAreaDTO
{
    private string $id;
    private float $n;

    public function __construct(
        string $id,
        float $n
    ) {
        $this->id = $id;
        $this->n = $n;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getN(): float
    {
        return $this->n;
    }
}
