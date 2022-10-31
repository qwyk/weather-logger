<?php

namespace Tests\Unit\Domain\Weather\Models;

use App\Domain\Weather\Models\WeatherRequest;
use App\Integrations\OpenWeatherMap\DataTransferObjects\Weather;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\TestCase;

class WeatherRequestTest extends \Tests\TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function itCanCreateAndPersistAWeatherRequest(): void
    {
        $weatherRequest = WeatherRequest::factory()->for(User::factory())->create();
        $this->assertInstanceOf(WeatherRequest::class, $weatherRequest);
    }

    /** @test */
    public function itReturnsTheWeatherRequestData(): void
    {
        /** @var WeatherRequest $weatherRequest */
        $weatherRequest = WeatherRequest::factory()->for(User::factory())->create();
        $data = $weatherRequest->toWeatherRequestData();
        $this->assertEquals($weatherRequest->location, $data->location);
    }


}
