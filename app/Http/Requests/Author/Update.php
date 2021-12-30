<?php

namespace App\Http\Requests\Author;

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
            'id' => $this->route('author'),
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:'.Author::class.',id'],
            'name' => ['required', 'string']
        ];
    }
}