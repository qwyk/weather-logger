<?php

namespace App\Domain\Weather\Actions;

use App\Domain\Weather\Models\WeatherRequest;
use App\Integrations\DataTransferObjects\WeatherRequestData;
use App\Models\User;

class CreateWeatherRequestAction
{
    public function execute(WeatherRequestData $data, User $user): WeatherRequest {
        // TODO: implement
    }
}
