<?php

namespace Rogue\AreaCalculator\Weather\Infraestructure\Services\HttpClients;

use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class OpenWeatherMapClient
{
    private const BASE_URL = 'api.openweathermap.org/data/2.5/';
    private const ACTION = 'forecast';
    private const TOKEN = '73fa0bc42625b39329eb809aa0f86259';

    public function getTomorrowWeather(string $city = 'Barcelona', string $country = 'es'): array
    {
        if (Cache::has('weather')) {
            return Cache::get('weather');
        }
        $q = $city . ',' . $country;
        $tomorrow = date_add(date_create(), date_interval_create_from_date_string("1 day"));
        $dayAfterTomorrow = date_add(date_create(), date_interval_create_from_date_string("2 day"));
        $date = new DateTime();
        $response = Http::get(
            self::BASE_URL . self::ACTION . '?q=' . $q . '&APPID=' . self::TOKEN
        );
        $jsonBody = $response->json();
        foreach ($jsonBody['list'] as $day) {
            if ($date->setTimestamp($day['dt']) >= $tomorrow && $date->setTimestamp($day['dt']) <= $dayAfterTomorrow) {
                Cache::put('weather', $day, 259200);
                return $day;
            }
        };
    }
}
