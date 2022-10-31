<?php

namespace Tests\Unit\Domain\Weather\Actions;

use App\Domain\Weather\Actions\CreateWeatherRequestAction;
use App\Domain\Weather\DataTransferObjects\CreateWeatherRequestData;
use App\Domain\Weather\Jobs\ProcessWeatherRequest;
use App\Domain\Weather\Models\WeatherRequest;
use App\Integrations\DataTransferObjects\WeatherRequestData;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class CreateWeatherRequestActionTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function itCreatesANewWeatherRequest(): void
    {
        Bus::fake();

        /** @var CreateWeatherRequestAction $action */
        $action = app(CreateWeatherRequestAction::class);

        $data = new CreateWeatherRequestData(['location' => $this->faker->city]);

        $action->execute($data, $this->user);

        $this->assertDatabaseHas(WeatherRequest::class, [
            'user_id'  => $this->user->id,
            'location' => $data->location
        ]);

        Bus::assertDispatched(ProcessWeatherRequest::class);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }


}
