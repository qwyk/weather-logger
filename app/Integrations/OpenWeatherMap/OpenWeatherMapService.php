<?php

namespace App\Integrations\OpenWeatherMap;

use App\Integrations\Contracts\WeatherService;
use App\Integrations\DataTransferObjects\WeatherRequestData;
use App\Integrations\DataTransferObjects\WeatherResponseData;
use App\Integrations\OpenWeatherMap\DataTransferObjects\OpenWeatherMapResponseData;
use Illuminate\Support\Facades\Http;

class OpenWeatherMapService implements WeatherService
{
    final public function getWeather(WeatherRequestData $request): WeatherResponseData
    {
        $query = http_build_query([
            'APPID' => app()->config->get('open-weather-map.app_id'),
            'q' => $request->cityName
        ]);

        $response = Http::baseUrl(app()->config->get('open-weather-map.domain'))
            ->timeout(30)
            ->get(sprintf('/data/2.5/weather?%s', $query));

        $response->throwIf($response->failed());

        return (new OpenWeatherMapResponseData($response->json()))->toWeatherResponse();
    }
}
