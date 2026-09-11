<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManagerRequest extends FormRequest
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
    $manager = $this->route('manager');

    return [
        'name' => ['required', 'string', 'min:3', 'max:60'],
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('managers', 'email')->ignore($manager)
        ],
    ];
}

public function messages(): array
{
    return [
        'name.required' => 'El nombre es obligatorio',
        'email.unique' => "Ese correo ya pertenece a otro responsable",
    ];
}
}