<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexLandsAbsorptionRequest extends FormRequest
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
            'page' => 'nullable|integer',
            'size' => 'nullable|integer',
            'search' => 'nullable|string',

            'state' => 'nullable|string',
            'land_condition' => 'nullable|in:Fully Developed,Undeveloped',
            'abs_size_ha' => 'nullable|integer',
            'abs_broker_id' => 'nullable|integer',
            'abs_industry_id' => 'nullable|integer',

            'column' => 'nullable|in:land_state,land_condition,abs_size_ha,abs_broker_id,abs_industry_id',
        ];
    }
}
