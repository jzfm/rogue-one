<?php

namespace Rogue\AreaCalculator\Weather\Infraestructure\DAOs;

use Exception;
use Throwable;
use Rogue\Shared\Infraestructure\Exceptions\HttpRestException;
use Rogue\AreaCalculator\Weather\Infraestructure\Services\HttpClients\OpenWeatherMapClient;

class WeatherDAO
{
    private OpenWeatherMapClient $openWeatherMapClient;

    public function __construct()
    {
        $this->openWeatherMapClient = new OpenWeatherMapClient();
    }

    public function getTomorrowWeather(): array
    {
        try {
            return $this->openWeatherMapClient->getTomorrowWeather();
        } catch (Exception $e) {
            throw HttpRestException::cannotConnect();
        } catch (Throwable $t) {
            throw HttpRestException::cannotConnect();
        }
    }
}
