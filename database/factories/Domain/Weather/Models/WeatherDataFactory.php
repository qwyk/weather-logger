<?php

namespace Database\Factories\Domain\Weather\Models;

use App\Domain\Weather\Models\WeatherData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Weather\Models\WeatherData>
 */
class WeatherDataFactory extends Factory
{
    protected $model = WeatherData::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
}
