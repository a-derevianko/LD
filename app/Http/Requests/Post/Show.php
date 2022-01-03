<?php

namespace App\Http\Requests\Post;

use App\Entities\Post;
use Illuminate\Foundation\Http\FormRequest;

class Show extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('post'),
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:'.Post::class.',id'],
        ];
    }
}