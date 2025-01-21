<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvertToAvailableRequest extends FormRequest
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
            'avl_building_dimensions' => 'required|string|max:45',
            'avl_minimum_space_sf' => 'nullable|integer|min:0',
            'avl_expansion_up_to_sf' => 'nullable|integer|min:0',
            'avl_date' => 'nullable|date',
            'avl_min_lease' => 'required|numeric|min:0',
            'avl_max_lease' => 'required|numeric|min:0',
            'avl_building_phase' => 'required|in:Construction,Planned,Sublease,Expiration,Inventory',
            'has_expansion_land' => 'required|boolean',
            'has_crane' => 'required|boolean',
            'has_hvac' => 'required|boolean',
            'has_rail_spur' => 'required|boolean',
            'has_sprinklers' => 'required|boolean',
            'has_office' => 'required|boolean',
            'has_leed' => 'required|boolean',
        ];
    }
}
