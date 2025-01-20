<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLandAvailableRequest extends FormRequest
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
            'avl_broker_id' => 'required|integer|exists:cat_developers,id',
            'avl_size_sm' => 'nullable|integer',
            'avl_minimum' => 'nullable|integer',
            'avl_land_sm' => 'nullable|numeric',
            'avl_min_sale' => 'nullable|numeric',
            'avl_max_sale' => 'nullable|numeric',
            'avl_zoning' => 'nullable|in:Industrial',
            'avl_pacel_shape' => 'nullable|in:Regular,Irregular',
            'avl_rail_spur' => 'nullable|boolean',
            'avl_natural_gas' => 'nullable|boolean',
            'avl_sewage' => 'nullable|boolean',
            'avl_water' => 'nullable|boolean',
            'avl_electric' => 'nullable|boolean',
            'avl_conditioned_construction' => 'nullable|boolean',
            'avl_quarter' => 'nullable|integer|min:1|max:4',
            'avl_year' => 'nullable|integer|digits:4|min:1900|max:' . date('Y'),
            'land_condition' => 'nullable|in:Fully Developed,Undeveloped',
            'comments' => 'nullable|string|max:45',
        ];
    }
}
