<?php

namespace App\Http\Requests\Post;

use App\Entities\Author;
use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author' => ['required', 'int', 'exists:'.Author::class.',id'],
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
        ];
    }
}