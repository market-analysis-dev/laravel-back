<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuildingsAvailableRequest extends FormRequest
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
            'building_id' => 'required|integer|exists:buildings,id',
            'broker_id' => 'required|integer|exists:cat_developers,id',
            'avl_size_sf' => 'required|integer|min:0',
            'avl_building_dimensions' => 'required|string|max:45',
            'avl_minimum_space_sf' => 'nullable|integer|min:0',
            'avl_expansion_up_to_sf' => 'nullable|integer|min:0',
            'dock_doors' => 'nullable|integer|min:0',
            'drive_in_door' => 'nullable|integer|min:0',
            'floor_thickness' => 'nullable|integer|min:0',
            'floor_resistance' => 'nullable|string|max:255',
            'truck_court' => 'nullable|integer|min:0',
            'has_crossdock' => 'nullable|boolean',
            'shared_truck' => 'nullable|boolean',
            'new_construction' => 'nullable|boolean',
            'is_starting_construction' => 'nullable|boolean',
            'bay_size' => 'nullable|string|max:45',
            'columns_spacing' => 'nullable|string|max:45',
            'avl_date' => 'nullable|date',
            'knockouts_docks' => 'nullable|integer|min:0',
            'parking_space' => 'nullable|integer|min:0',
            'avl_min_lease' => 'required|numeric|min:0',
            'avl_max_lease' => 'required|numeric|min:0',
            'created_by' => 'nullable|integer|exists:users,id',
            'updated_by' => 'nullable|integer|exists:users,id',
            'building_state' => 'required|in:Availability',
            'avl_building_phase' => 'required|in:Construction,Planned,Sublease,Expiration,Inventory',
        ];
    }
}
