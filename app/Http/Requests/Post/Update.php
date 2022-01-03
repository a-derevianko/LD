<?php

namespace App\Http\Requests\Post;

use App\Entities\Author;
use App\Entities\Post;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('post'),
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:'.Post::class.',id'],
            'author' => ['required', 'int', 'exists:'.Author::class.',id'],
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
        ];
    }
}