<?php

namespace App\Domain\Weather;

use App\Domain\Weather\Models\WeatherRequest;
use App\Domain\Weather\Policies\WeatherRequestPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class WeatherServiceProvider extends AuthServiceProvider
{
    public $policies = [
        WeatherRequest::class => WeatherRequestPolicy::class
    ];
}
