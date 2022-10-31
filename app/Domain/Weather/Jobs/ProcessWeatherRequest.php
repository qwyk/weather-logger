<?php

namespace App\Domain\Weather\Jobs;

use App\Domain\Weather\Models\WeatherRequest;
use App\Integrations\Contracts\WeatherService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessWeatherRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public WeatherRequest $weatherRequest)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(WeatherService $service): void
    {
        $service->getWeather($this->weatherRequest->toWeatherRequestData());
        // TODO: handle response
    }
}
