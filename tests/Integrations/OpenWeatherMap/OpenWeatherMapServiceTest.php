<?php

namespace Tests\Integrations\OpenWeatherMap;

use App\Integrations\DataTransferObjects\WeatherRequestData;
use App\Integrations\DataTransferObjects\WeatherResponseData;
use App\Integrations\OpenWeatherMap\OpenWeatherMapService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Str;
use Tests\TestCase;
use Illuminate\Http\Client\Request;

class OpenWeatherMapServiceTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function itGetsTheWeather(): void
    {
        /** @var OpenWeatherMapService $service */
        $service = app(OpenWeatherMapService::class);

        $owmAppId = Str::random(15);
        app()->config->set('open-weather-map.app_id', $owmAppId);

        $cityName = $this->faker->city;
        $request  = new WeatherRequestData(['cityName' => $cityName]);

        $expectedQuery = http_build_query([
            'APPID' => $owmAppId,
            'q'     => $cityName
        ]);

        $stubResponse = $this->loadStubData('weather_response', __DIR__.'/stubs/');

        $expectedUrl = sprintf('%s/data/2.5/weather?%s', app()->config->get('open-weather-map.domain'), $expectedQuery);
        Http::fake([
            $expectedUrl => Http::response($stubResponse),
            '*'          => Http::response([], 404)
        ]);

        $service->getWeather($request);

        Http::assertSent(static function(Request $request) use ($expectedUrl) {
            return $request->url() === $expectedUrl;
        });
    }
}
