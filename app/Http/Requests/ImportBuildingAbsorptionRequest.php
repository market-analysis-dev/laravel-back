<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportBuildingAbsorptionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:csv,txt'],
        ];

    }

    public function messages(): array
    {
        return [
            'file.required' => 'Debes subir un archivo.',
            'file.file' => 'El archivo debe ser válido.',
            'file.mimes' => 'El archivo debe ser de tipo CSV.',
        ];
    }

}
