<?php

namespace App\Domain\Weather\Models;

use App\Domain\Common\UuidModel;
use App\Integrations\DataTransferObjects\WeatherRequestData;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeatherRequest extends UuidModel
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function weatherData(): BelongsTo
    {
        return $this->belongsTo(WeatherData::class);
    }

    public function toWeatherRequestData(): WeatherRequestData
    {
        return new WeatherRequestData(location: $this->location);
    }
}
