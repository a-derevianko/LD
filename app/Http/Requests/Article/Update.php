<?php

namespace App\Http\Requests\Article;

use App\Entities\Article;
use App\Entities\Author;
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
            'id' => $this->route('article'),
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:'.Article::class.',id'],
            'author_id' => ['required', 'int', 'exists:'.Author::class.',id'],
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
        ];
    }
}