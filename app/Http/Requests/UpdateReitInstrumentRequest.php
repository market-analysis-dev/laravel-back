<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReitInstrumentRequest extends FormRequest
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
            'reit_type_id' => 'required|exists:cat_reit_types,id',
            'name' => 'required|string|max:50',
            'present_value' => 'required|numeric|min:0|max:99999999.99',
            'return' => 'required|numeric|min:0|max:99.99',
            'real_return' => 'required|numeric|min:0|max:99.99',
        ];
    }
}
