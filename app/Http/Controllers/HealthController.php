<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class HealthController extends Controller
{
    public function check(): array
    {
        $startTime = microtime(true);
        $name = config('app.name');
        return [
            'name' => $name,
            'env' => App::environment(),
            'status' => 'pass',
            'output' => $name . ' Application is running ok',
            'latency' => round((microtime(true) - $startTime) * 1000, 2) . ' ms'
        ];
    }
}
