<?php

namespace Tests\Unit\Domain\Weather\Models;

use App\Domain\Comment\Models\Comment;
use App\Domain\Weather\Models\WeatherRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherRequestTest extends TestCase
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
        $data           = $weatherRequest->toWeatherRequestData();
        $this->assertEquals($weatherRequest->location, $data->location);
    }

    /** @test */
    public function itCanHaveComments(): void
    {
        $weatherRequest = WeatherRequest::factory()->for(User::factory())->create();

        Comment::factory()->for($weatherRequest, 'commentable')->count(5)->create();

        $this->assertCount(5, $weatherRequest->comments);
    }


}
