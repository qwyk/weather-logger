<?php

namespace App\Integrations\OpenWeatherMap\DataTransferObjects;

use App\Integrations\DataTransferObjects\WeatherResponseData;
use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class OpenWeatherMapResponseData extends DataTransferObject
{
    public string $name; // Location
    public int $dt; // Date
    /** @var \App\Integrations\OpenWeatherMap\DataTransferObjects\Weather[] */
    public array $weather;
    public Main $main;

    public function toWeatherResponse(): WeatherResponseData
    {
        return new WeatherResponseData(
            [
                'location'    => $this->name,
                'description' => $this->weather[0]['description'],
                'timestamp'   => $this->getDate(),
                'temperature' => $this->main->temp,
                'humidity'    => $this->main->humidity
            ]
        );
    }

    public function getDate(): ?Carbon
    {
        return Carbon::parse($this->dt);
    }
}
