<?php

namespace Tests\Unit\Domain\Weather\Models;

use App\Domain\Weather\Models\WeatherData;
use App\Integrations\DataTransferObjects\WeatherResponseData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class WeatherDataTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function itCanBeCreatedFromWeatherResponseData(): void
    {
        $mockResponse = new WeatherResponseData(
            location: $this->faker->city,
            description: $this->faker->text(20),
            timestamp: Carbon::now(),
            temperature: $this->faker->numberBetween(100, 200),
            humidity: $this->faker->numberBetween(20, 100)
        );

        WeatherData::fromWeatherResponseData($mockResponse);
        $this->assertDatabaseHas(WeatherData::class, $mockResponse->toArray());
    }
}
