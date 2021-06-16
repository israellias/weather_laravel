<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $cityId = $request->get('city');
        $city = City::find($cityId);

        $url = config('services.open_weather_endpoint') . '/data/2.5/onecall';
        $response = Http::get($url, [
            'lon' => $city->lon,
            'lat' => $city->lat,
            'exclude' => 'minutely,hourly',
            'units' => 'metric',
            'appid' => config('services.open_weather_api_key'),
            'lang' => 'es'
        ]);
        return $response->json();
    }
}
