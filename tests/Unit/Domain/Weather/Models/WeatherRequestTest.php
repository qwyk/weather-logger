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

}
