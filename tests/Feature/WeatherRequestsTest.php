<?php

namespace Tests\Feature;

use App\Domain\Comment\Models\Comment;
use App\Domain\Weather\Actions\CreateWeatherRequestAction;
use App\Domain\Weather\Models\WeatherRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\MockInterface;
use Tests\TestCase;

class WeatherRequestsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private User $user;

    /** @test */
    public function itGetsAListOfWeatherRequests(): void
    {
        WeatherRequest::factory()
                      ->for($this->user)
                      ->count(40)
                      ->create();

        $this->actingAs($this->user)
             ->getJson('/api/weather-requests?page=2')
             ->assertOk()
             ->assertJsonStructure([
                 'data' => [
                     '*' => [
                         'id',
                         'location'
                     ]
                 ],
                 'links',
                 'meta'
             ])
             ->assertJsonPath('meta.total', 40)
             ->assertJsonPath('meta.current_page', 2);
    }

    /** @test */
    public function itGetsAWeatherRequestById(): void
    {
        $weatherRequest = WeatherRequest::factory()->for($this->user)->create();

        $this->actingAs($this->user)
             ->getJson(sprintf('/api/weather-requests/%s', $weatherRequest->id))
             ->assertOk()
             ->assertJsonStructure([
                 'data' => [
                     'id',
                     'location'
                 ],

             ])
             ->assertJsonPath('data.id', $weatherRequest->id);
    }

    /** @test */
    public function itForbidsAccessingAWeatherRequestOfAnotherUser(): void
    {
        $weatherRequest = WeatherRequest::factory()->for(User::factory())->create();

        $this->actingAs($this->user)
             ->getJson(sprintf('/api/weather-requests/%s', $weatherRequest->id))
             ->assertForbidden();
    }


    /** @test */
    public function itCreatesANewWeatherRequest(): void
    {
        $fakeWeatherRequest = WeatherRequest::factory()->for($this->user)->create();

        $this->mock(CreateWeatherRequestAction::class, function (MockInterface $mock) use ($fakeWeatherRequest) {
            $mock->expects('execute')->once()->andReturn($fakeWeatherRequest);
        });

        $payload = [
            'location' => $this->faker->city,
        ];

        $this->actingAs($this->user)
             ->postJson('/api/weather-requests', $payload)
             ->assertCreated()
             ->assertJsonStructure([
                 'data' => [
                     'id',
                     'location'
                 ]
             ]);
    }

    /** @test */
    public function itSoftDeletesAWeatherRequestById(): void
    {
        $weatherRequest = WeatherRequest::factory()->for($this->user)->create();

        $this->actingAs($this->user)
             ->deleteJson(sprintf('/api/weather-requests/%s', $weatherRequest->id))
             ->assertNoContent();

        $this->assertSoftDeleted($weatherRequest);
    }

    /** @test */
    public function itGetsCommentsForTheWeatherRequest(): void
    {
        $weatherRequest = WeatherRequest::factory()->for($this->user)->create();

        $count = 10;
        Comment::factory()->for($weatherRequest, 'commentable')->count($count)->create();

        $this->actingAs($this->user)
             ->getJson(sprintf('/api/weather-requests/%s/comments', $weatherRequest->id))
             ->assertOk()
             ->assertJsonStructure([
                 'data' => [
                     '*' => [
                         'id',
                         'content',
                         'created_at'
                     ]
                 ],
                 'meta',
                 'links'
             ])
             ->assertJsonPath('meta.total', $count);
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }


}
