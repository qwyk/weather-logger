<?php

namespace App\Integrations\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class WeatherRequestData extends DataTransferObject
{
    public string $cityName;
}
