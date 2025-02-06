<?php

namespace App\Http\Requests;

use App\Models\Building;
use App\Models\BuildingAvailable;
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
            'broker_id' => 'required|integer|exists:cat_developers,id',
            'dock_doors' => 'nullable|integer|min:0',
            'rams' => 'nullable|integer|min:0',
            'truck_court_ft' => 'nullable|integer|min:0',
            'shared_truck' => 'nullable|boolean',
            'new_construction' => 'nullable|boolean',
            'is_starting_construction' => 'nullable|boolean',
            'bay_size' => 'nullable|string|max:45',
            'columns_spacing' => 'nullable|string|max:45',
            'parking_space' => 'nullable|integer|min:0',
            'trailer_parking_space' => 'nullable|integer|min:0',
            'fire_protection_system' => 'required|in:Hose Station,Sprinkler,Extinguisher',
            'above_market_tis' => 'nullable|in:HVAC,CRANE,Rail Spur,Sprinklers,Crossdock,Office,Leed,Land Expansion',
            'avl_building_dimensions_ft' => 'required|string|max:45',
            'avl_minimum_space_sf' => 'nullable|integer|min:0',
            'avl_date' => 'nullable|date',
            'avl_min_lease' => 'required|numeric|min:0',
            'avl_max_lease' => 'required|numeric|min:0',
            'avl_building_phase' => 'required|in:Construction,Planned,Sublease,Expiration,Inventory',
            'size_sf' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    $buildingId = $this->route('building')->id ?? null;
                    $buildingAvailableId = $this->route('buildingAbsorption')->id ?? null;

                    if (!$buildingId) {
                        return $fail(__('Building ID is required.'));
                    }

                    $building = Building::find($buildingId);

                    if (!$building) {
                        return $fail(__('Building does not exist.'));
                    }

                    if ($value > $building->building_size_sf) {
                        return $fail(__('The size_sf of buildings_available must be less than or equal to the building_size_sf of buildings.'));
                    }

                    $totalAbsorbed = BuildingAvailable::where('building_id', $buildingId)
                        ->sum('size_sf');


                    $currentSizeSf = BuildingAvailable::where('id', $buildingAvailableId)->value('size_sf') ?? 0;

                    if (($totalAbsorbed - $currentSizeSf + $value) > $building->building_size_sf) {
                        return $fail(__('The total sum of size_sf for all availability/absorption records must be less than or equal to the building_size_sf of buildings.'));
                    }
                },
            ],
        ];
    }
}
