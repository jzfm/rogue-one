<?php

namespace Rogue\AreaCalculator\Weather\Application\Repositories;

use Rogue\AreaCalculator\Weather\Domain\Weather;
use Rogue\AreaCalculator\Weather\Infraestructure\DAOs\WeatherDAO;

class OpenWeatherMapRepository
{
    private WeatherDAO $dao;

    public function __construct()
    {
        $this->dao = new WeatherDAO();
    }

    public function getTomorrowWeather(): Weather
    {
        $weatherJson = $this->dao->getTomorrowWeather();
        $wind = $this->formatWind($weatherJson);
        $humidity = $weatherJson['main']['humidity'];
        $weather = new Weather($wind, $humidity);
        return $weather;
    }

    private function formatWind(array $json): string
    {
        $windDescription = $json['weather'][0]['description'];
        $windSpeed = $json['wind']['speed'] . ' m/s';
        return $windDescription . ', ' . $windSpeed;
    }
}
