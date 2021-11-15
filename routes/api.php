<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('v1')->middleware('force.json')->group(
    function () {
        Route::get(
            '/health',
            [
                'uses' => 'HealthController@check'
            ]
        );

        Route::get(
            '/area/{uuid}',
            [
                'uses' => 'Area\GetAreaController@getById'
            ]
        );

        Route::post(
            '/area',
            [
                'uses' => 'Area\CalculateAreaController@calculate'
            ]
        );
    }
);
