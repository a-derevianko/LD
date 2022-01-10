<?php

namespace App\Http\Requests\Article;

use App\Entities\Article;
use Illuminate\Foundation\Http\FormRequest;

class Destroy extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('article'),
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:'.Article::class.',id'],
        ];
    }
}