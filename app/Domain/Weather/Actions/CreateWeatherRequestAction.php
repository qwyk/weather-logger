<?php

namespace App\Domain\Weather\Actions;

use App\Domain\Weather\DataTransferObjects\CreateWeatherRequestData;
use App\Domain\Weather\Jobs\ProcessWeatherRequest;
use App\Domain\Weather\Models\WeatherRequest;
use App\Models\User;

class CreateWeatherRequestAction
{
    public function execute(CreateWeatherRequestData $data, User $user): WeatherRequest
    {
        $weatherRequest = WeatherRequest::create([
            'location' => $data->location,
            'user_id'  => $user->id
        ]);

        ProcessWeatherRequest::dispatch($weatherRequest);

        return $weatherRequest;
    }
}
