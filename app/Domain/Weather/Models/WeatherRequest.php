<?php

namespace App\Domain\Weather\Models;

use App\Domain\Common\UuidModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeatherRequest extends UuidModel
{
    use HasFactory;
    use SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
