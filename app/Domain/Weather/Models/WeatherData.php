<?php

namespace App\Domain\Weather\Models;

use App\Domain\Common\UuidModel;
use App\Integrations\DataTransferObjects\WeatherResponseData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WeatherData extends UuidModel
{
    use HasFactory;

    protected $guarded = false;

    public static function fromWeatherResponseData(WeatherResponseData $response): self
    {
        return self::create($response->toArray());
    }

    public function weatherRequests(): HasMany
    {
        return $this->hasMany(WeatherRequest::class);
    }
}
