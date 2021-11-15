<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateAreaRequest;
use Rogue\AreaCalculator\Area\Infraestructure\Services\Controllers\CalculateAreaController as CalculateAreaService;

class CalculateAreaController extends Controller
{
    public function calculate(CalculateAreaRequest $request): array
    {
        $calculateAreaService = new CalculateAreaService($request);
        $response = $calculateAreaService->calculate();
        return $response;
    }
}
