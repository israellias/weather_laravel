<?php

use App\Http\Controllers\Api\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    Route::resource('/cities', CityController::class)->only(['index']);
    Route::get('/weather', function (Request $request) {
        $url = config('services.open_weather_endpoint') . '/data/2.5/onecall';
        $response = Http::get($url, [
            'lon' => -63.166672,
            'lat' => -17.799999,
            'exclude' => 'minutely,hourly',
            'units' => 'metric',
            'appid' => config('services.open_weather_api_key'),
            'lang' => 'es'
        ]);
        return $response->json();
    });
});

