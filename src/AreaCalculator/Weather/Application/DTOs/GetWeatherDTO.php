<?php

namespace Rogue\AreaCalculator\Weather\Application\DTOs;

class GetWeatherDTO
{
    private string $wind;
    private string $humidity;

    public function __construct(
        string $wind,
        string $humidity
    ) {
        $this->wind = $wind;
        $this->humidity = $humidity;
    }

    public function getWind(): string
    {
        return $this->wind;
    }

    public function getHumidity(): string
    {
        return $this->humidity;
    }
}
