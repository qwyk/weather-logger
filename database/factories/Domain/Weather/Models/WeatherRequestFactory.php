<?php

namespace Database\Factories\Domain\Weather\Models;

use App\Domain\Weather\Models\WeatherRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Weather\Models\WeatherRequest>
 */
class WeatherRequestFactory extends Factory
{
    protected $model = WeatherRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location' => $this->faker->city
        ];
    }
}
