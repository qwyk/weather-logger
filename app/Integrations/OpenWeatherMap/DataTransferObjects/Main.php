<?php

namespace App\Integrations\OpenWeatherMap\DataTransferObjects;

class Main extends \Spatie\DataTransferObject\DataTransferObject
{
    public int $temp;
    public int $humidity;
}
