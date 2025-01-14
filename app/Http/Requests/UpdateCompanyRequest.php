<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'logo_id' => 'integer|exists:files,id|nullable',
            'name' => 'required|string|max:100',
            'website' => 'string|max:100|nullable',
            'primary_color' => 'string|max:7|nullable',
            'secondary_color' =>'string|max:7|nullable',
        ];
    }
}
