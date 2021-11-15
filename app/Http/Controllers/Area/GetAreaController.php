<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use Rogue\AreaCalculator\Area\Infraestructure\Services\Controllers\GetAreaController as GetAreaService;

class GetAreaController extends Controller
{
    public function getById(string $id): array
    {
        $getAreaService = new GetAreaService($id);
        $response = $getAreaService->getAreaAndWeatherById();
        return $response;
    }
}
