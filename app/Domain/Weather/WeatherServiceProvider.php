<?php

namespace App\Domain\Weather;

use App\Domain\Weather\Models\WeatherRequest;
use App\Domain\Weather\Policies\WeatherRequestPolicy;
use App\Integrations\Contracts\WeatherService;
use App\Integrations\OpenWeatherMap\OpenWeatherMapService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class WeatherServiceProvider extends AuthServiceProvider
{
    public $policies = [
        WeatherRequest::class => WeatherRequestPolicy::class
    ];

    public function register()
    {
        parent::register();
        $this->app->bind(WeatherService::class, OpenWeatherMapService::class);
    }
}
