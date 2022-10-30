<?php

namespace App\Integrations\Contracts;

use App\Integrations\DataTransferObjects\WeatherRequestData;
use App\Integrations\DataTransferObjects\WeatherResponseData;

interface WeatherService
{
    public function getWeather(WeatherRequestData $request): WeatherResponseData;
}
