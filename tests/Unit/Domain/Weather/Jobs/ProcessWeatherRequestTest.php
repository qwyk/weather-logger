<?php

namespace Tests\Unit\Domain\Weather\Jobs;

use App\Domain\Weather\Jobs\ProcessWeatherRequest;
use App\Domain\Weather\Models\WeatherRequest;
use App\Integrations\Contracts\WeatherService;
use App\Integrations\DataTransferObjects\WeatherResponseData;
use App\Integrations\OpenWeatherMap\OpenWeatherMapService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class ProcessWeatherRequestTest extends \Tests\TestCase
{


    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function itUsesTheOpenWeatherMapService(): void
    {
        $service = app(WeatherService::class);
        $this->assertInstanceOf(OpenWeatherMapService::class, $service);
    }

    /** @test */
    public function itGetsTheWeatherRequest(): void
    {
        $weatherRequest = WeatherRequest::factory()->for(User::factory())->create();
        $mockResponse = new WeatherResponseData(
            location: $this->faker->city,
            description: $this->faker->text(20),
            timestamp: Carbon::now(),
            temperature: $this->faker->numberBetween(100, 200),
            humidity: $this->faker->numberBetween(20, 100)
        );

        $this->mock(WeatherService::class, function(MockInterface $mock) use ($mockResponse) {
            $mock->expects('getWeather')->once()->andReturn($mockResponse);
        });

        (new ProcessWeatherRequest($weatherRequest))->handle(app(WeatherService::class));
    }

}
