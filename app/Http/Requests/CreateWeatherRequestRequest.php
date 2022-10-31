<?php

namespace App\Http\Requests;

use App\Integrations\DataTransferObjects\WeatherRequestData;
use Illuminate\Foundation\Http\FormRequest;

class CreateWeatherRequestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'location' => 'required|string|max:255'
        ];
    }

    public function toData(): WeatherRequestData {
        return new WeatherRequestData($this->validated());
    }
}
