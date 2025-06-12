<?php

namespace App\Http\Requests;

use App\Models\Building;
use App\Models\BuildingAvailable;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBuildingAvailableDraftRequest extends FormRequest
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
            'broker_id' => 'required|integer|exists:cat_brokers,id',
            'building_available_id' => 'nullable|integer|exists:buildings_available,id',
            'building_dimensions_ft' => 'required|string|max:45',
            'avl_minimum_space_sf' => 'required|integer|min:0',
            'dock_doors' => 'required|integer|min:0',
            'ramps' => 'required|integer|min:0',
            'truck_court_ft' => 'required|integer|min:0',
            'kvas_fees_paid' => 'nullable|string|max:20',
            'shared_truck' => 'nullable|boolean',
            'is_new_construction' => 'nullable|boolean',
            'is_starting_construction' => 'nullable|boolean',
            'bay_size' => 'nullable|string|max:45',
            'avl_date' => 'nullable|date',
            'parking_space' => 'required|integer|min:0',
            'avl_min_lease' => 'required|numeric|min:0',
            'avl_max_lease' => 'required|numeric|min:0',
            'knockout_docks' => 'nullable|numeric|min:0',
            'avl_deal' => 'required|in:Sale,Lease',
            'created_by' => 'nullable|integer|exists:users,id',
            'updated_by' => 'nullable|integer|exists:users,id',
            'offices_space_sf' => 'required|integer|min:0',
            'avl_type' => 'required|in:Construction,Planned,Sublease,Expiration,Inventory',
            'status' => 'in:Enabled,Draft',
            'trailer_parking_space' => 'required|integer|min:0',
            'fire_protection_system' => [
                'required',
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
            'sqftToM2' => 'boolean',
            'yrToMo' => 'boolean',
            'has_tis_hvac'           => 'boolean',
            'has_tis_crane'          => 'boolean',
            'has_tis_rail_spur'      => 'boolean',
            'has_tis_sprinklers'     => 'boolean',
            'has_tis_crossdock'      => 'boolean',
            'has_tis_office'         => 'boolean',
            'has_tis_leed'           => 'boolean',
            'has_tis_land_expansion' => 'boolean',
            'size_sf' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    $buildingId = $this->route('building')->id ?? null;
                    $buildingAvailableId = $this->route('buildingAvailable')->id ?? null;

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
