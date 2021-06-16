<?php

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

Route::middleware('api')->group(function() {
    Route::get('/cities', function (Request $request) {
        return [
            [
                "id" => 833,
                "name" => "Ḩeşār-e Sefīd",
                "state" => "",
                "country" => "IR",
                "coord" => [
                    "lon" => 47.159401,
                    "lat" => 34.330502
                ]
            ],
            [
                "id" => 2960,
                "name" => "‘Ayn Ḩalāqīm",
                "state" => "",
                "country" => "SY",
                "coord" => [
                    "lon" => 36.321911,
                    "lat" => 34.940079
                ]
            ]
        ];
    });

    Route::get('/weather', function(Request $request) {
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

