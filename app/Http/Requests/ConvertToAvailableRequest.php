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
            'broker_id' => 'sometimes|integer|exists:cat_brokers,id',
            'dock_doors' => 'required|integer|min:0',
            'ramps' => 'required|integer|min:0',
            'truck_court_ft' => 'required|integer|min:0',
            'shared_truck' => 'sometimes|boolean',
            'is_new_construction' => 'sometimes|boolean',
            'is_starting_construction' => 'sometimes|boolean',
            'bay_size' => 'sometimes|string|max:45',
            'parking_space' => 'required|integer|min:0',
            'trailer_parking_space' => 'required|integer|min:0',
            'fire_protection_system' => [
                'sometimes',
                'array',
                function ($attribute, $value, $fail) {
                    $allowedValues = ['Hose Station', 'Sprinkler', 'Extinguisher'];

                    foreach ($value as $item) {
                        if (!in_array($item, $allowedValues)) {
                            return $fail(__('Invalid value in fire_protection_system.'));
                        }
                    }
                }
            ],
            'building_dimensions_ft' => 'required|string|max:45',
            'avl_minimum_space_sf' => 'required|integer|min:0',
            'avl_date' => 'required|date',
            'avl_min_lease' => 'required|numeric|min:0',
            'avl_max_lease' => 'required|numeric|min:0',
            'avl_sale_price' => 'required|integer|min:0',
            'knockout_docks' => 'nullable|numeric|min:0',
            'avl_deal' => 'required|in:Sale,Lease',
            'has_tis_hvac'           => 'boolean',
            'has_tis_crane'          => 'boolean',
            'has_tis_rail_spur'      => 'boolean',
            'has_tis_sprinklers'     => 'boolean',
            'has_tis_crossdock'      => 'boolean',
            'has_tis_office'         => 'boolean',
            'has_tis_leed'           => 'boolean',
            'has_tis_land_expansion' => 'boolean',
            'avl_type' => 'required|in:Construction,Planned,Sublease,Expiration,Inventory',
            'size_sf' => [
                'sometimes',
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
