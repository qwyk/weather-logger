<?php

namespace Tests\Integrations\OpenWeatherMap\DataTransferObjects;

use App\Integrations\DataTransferObjects\WeatherResponseData;
use App\Integrations\OpenWeatherMap\DataTransferObjects\OpenWeatherMapResponseData;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OpenWeatherMapResponseDataTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function itLoadsFromWeatherResponse(): void
    {
        $stubResponse = $this->loadStubData('weather_response', __DIR__.'/../stubs/');
        $data         = new OpenWeatherMapResponseData($stubResponse);
        $this->assertNotNull($data);
    }

    /** @test */
    public function itReturnsWeatherResponseData(): void
    {
        $stubResponse = [
            'name'    => $this->faker->city,
            'weather' => [
                [
                    'description' => $this->faker->text(10)
                ]
            ],
            'main'    => [
                'temp' => $this->faker->numberBetween(100, 200),
                'humidity' => $this->faker->numberBetween(20, 100)
            ],
            'dt'      => Carbon::now()->setMilli(0)->getTimestamp()
        ];

        $data         = new OpenWeatherMapResponseData($stubResponse);

        $responseData = $data->toWeatherResponse();
        $this->assertEquals($stubResponse['name'], $responseData->location);
        $this->assertEquals($stubResponse['weather'][0]['description'], $responseData->description);
        $this->assertNotNull($responseData->timestamp);
        $this->assertEquals($stubResponse['main']['temp'], $responseData->temperature);
        $this->assertEquals($stubResponse['main']['humidity'], $responseData->humidity);
    }

    /** @test */
    public function itConvertsTheDateFromWeatherResponse(): void
    {
        $expectedDate = Carbon::now()->setMilli(0);

        $stubResponse = $this->loadStubData('weather_response', __DIR__.'/../stubs/');
        $stubResponse['dt'] = $expectedDate->getTimestamp();
        $data         = new OpenWeatherMapResponseData($stubResponse);

        $this->assertEquals($expectedDate, $data->getDate());
    }


}
