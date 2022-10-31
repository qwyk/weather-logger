<?php

namespace App\Http\Requests;

use App\Domain\Weather\DataTransferObjects\CreateWeatherRequestData;
use Illuminate\Foundation\Http\FormRequest;

class CreateWeatherRequestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'location' => 'required|string|max:255'
        ];
    }

    public function toData(): CreateWeatherRequestData
    {
        return new CreateWeatherRequestData($this->validated());
    }
}
