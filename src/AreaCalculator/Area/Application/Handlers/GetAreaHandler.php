<?php

namespace Rogue\AreaCalculator\Area\Application\Handlers;

use Rogue\AreaCalculator\Area\Application\DTOs\GetAreaDTO;
use Rogue\AreaCalculator\Area\Application\Repositories\AreaRepository;
use Rogue\AreaCalculator\Weather\Application\Repositories\OpenWeatherMapRepository;

class GetAreaHandler
{
    private GetAreaDTO $dto;
    private AreaRepository $areaRepository;
    private OpenWeatherMapRepository $openWeatherRepository;

    public function __construct(GetAreaDTO $dto)
    {
        $this->dto = $dto;
        $this->areaRepository = new AreaRepository();
        $this->openWeatherRepository = new OpenWeatherMapRepository();
    }

    public function getAreaAndTomorrowWeatherById(): array
    {
        $area = $this->areaRepository->getAreaById($this->dto->getId());
        $weather = $this->openWeatherRepository->getTomorrowWeather();

        return [
            'id' => $area->getId(),
            'area' => $area->getArea(),
            'weather' => [
                'wind' => $weather->getWind(),
                'humidity' => $weather->getHumidity()
            ]
        ];
    }
}
