<?php

namespace App\Http\Requests;

use App\Domain\Comment\DataTransferObjects\CreateCommentData;
use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'required|string|max:1000'
        ];
    }

    public function toData(): CreateCommentData {
        return new CreateCommentData($this->validated());
    }
}
