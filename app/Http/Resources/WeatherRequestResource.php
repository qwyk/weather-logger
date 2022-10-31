<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherRequestResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'location' => $this->location
        ];
    }
}
