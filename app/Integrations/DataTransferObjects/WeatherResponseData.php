<?php

namespace App\Integrations\DataTransferObjects;

use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class WeatherResponseData extends DataTransferObject
{
    public string $location;
    public string $description;
    public Carbon $timestamp;
    public int $temperature;
    public int $humidity;
}
