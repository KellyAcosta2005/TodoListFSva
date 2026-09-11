<?php

namespace App\Http\Requests;

use App\Rules\ProhibitedWords;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'title' => ['required', 'string', 'min:3', 'max:255'],
        'description' => ['nullable', 'string', 'max:400', new ProhibitedWords()],
        'completed' => ['sometimes', 'boolean'],
        'manager_id' => ['required', 'integer', 'exists:managers,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El titulo es obligatorio',
            'manager_id.exists' => 'El responsable seleccionado no existe',
        ];
    }
}
