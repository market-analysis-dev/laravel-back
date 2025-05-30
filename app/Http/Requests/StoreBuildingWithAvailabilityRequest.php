<?php

namespace App\Http\Requests;

use App\Models\Building;
use App\Models\BuildingAvailable;
use Illuminate\Foundation\Http\FormRequest;

class StoreBuildingWithAvailabilityRequest extends FormRequest
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
            'building' => ['required', 'array'],
            'building.id' => 'nullable|integer|exists:buildings,id',
            'building.region_id' => 'required|integer|exists:cat_regions,id',
            'building.market_id' => 'required|integer|exists:cat_markets,id',
            'building.sub_market_id' => 'required|integer|exists:cat_sub_markets,id',
            'building.builder_id' => 'required|integer|exists:cat_developers,id',
            'building.industrial_park_id' => 'required|integer|exists:industrial_parks,id',
            'building.developer_id' => 'nullable|integer|exists:cat_developers,id',
            'building.owner_id' => 'nullable|integer|exists:cat_developers,id',
            'building.building_name' => 'required|string|max:255',
            'building.building_size_sf' => 'required|integer',
            'building.latitud' => 'nullable|string|max:45',
            'building.longitud' => 'nullable|string|max:45',
            'building.year_built' => 'nullable|integer',
            'building.clear_height_ft' => 'required|integer|max:99',
            'building.total_land_sf' => 'required|integer|min:0|max:999999999999999999',
            'building.hvac_production_area' => 'nullable|string|max:45',
            'building.ventilation' => 'nullable|string|max:45',
            'building.roofing' => 'nullable|in:Butler,KR18,KR24,SSR LOK,TPO',
            'building.skylights_sf' => 'required|string|max:45',
            'building.coverage' => 'required|string|max:45',
            'building.transformer_capacity' => 'nullable|string|max:20',
            'building.expansion_land' => 'nullable|boolean',
            'building.columns_spacing_ft' => 'required|string|max:20',
            'building.floor_thickness_in' => 'required|integer|min:0',
            'building.floor_resistance' => 'required|string|max:255',
            'building.expansion_up_to_sf' => 'required|integer|min:0',
            'building.class' => 'required|in:A,B,C',
            'building.generation' => 'required|in:1st Generation,2nd Generation',
            'building.currency' => 'required|in:USD,MXP',
            'building.tenancy' => 'required|in:Single,Multitenant',
            'building.construction_type' => 'nullable|in:Precast,Tiltup,Concrete Masonry & Metal Sheet,Hebel,Concrete Masonry,Metal Sheet',
            'building.lightning' => 'nullable|in:LED,T5,T8,Metal Halide,None',
            'building.loading_door' => 'nullable|in:Crossdock,Back Loading,Front Loading',
            'building.building_type' => 'required|in:Spec,BTS,BTS Expansion,Expansion',
            'building.certifications' => 'required|in:None,LEED,EDGE,BOMA',
            'building.owner_type' => 'required|in:Investor,REITS,Developer,User Owner,Builder,Private Owner',
            'building.stage' => 'required|in:Availability,Construction,Leased,Sold',
            'building.sqftToM2' => 'boolean',
            'building.type' => 'nullable|string',

            'availability' => ['nullable', 'array'],
            'availability.broker_id' => 'required|integer|exists:cat_brokers,id',
            'availability.building_available_id' => 'nullable|integer|exists:buildings_available,id',
            'availability.building_dimensions_ft' => 'required|string|max:45',
            'availability.construction_size_sf' => 'required|integer|min:0',
            'availability.avl_minimum_space_sf' => 'required|integer|min:0',
            'availability.dock_doors' => 'required|integer|min:0',
            'availability.ramps' => 'required|integer|min:0',
            'availability.truck_court_ft' => 'required|integer|min:0',
            'availability.kvas_fees_paid' => 'nullable|string|max:20',
            'availability.shared_truck' => 'nullable|boolean',
            'availability.is_new_construction' => 'nullable|boolean',
            'availability.is_starting_construction' => 'nullable|boolean',
            'availability.bay_size' => 'nullable|string|max:45',
            'availability.avl_date' => 'nullable|date',
            'availability.parking_space' => 'required|integer|min:0',
            'availability.avl_min_lease' => 'required|numeric|min:0',
            'availability.avl_max_lease' => 'required|numeric|min:0',
            'availability.avl_sale_price' => 'required|integer|min:0',
            'availability.knockout_docks' => 'nullable|numeric|min:0',
            'availability.created_by' => 'nullable|integer|exists:users,id',
            'availability.updated_by' => 'nullable|integer|exists:users,id',
            'availability.offices_space_sf' => 'required|integer|min:0',
            'availability.avl_type' => 'required|in:Construction,Planned,Sublease,Expiration,Inventory',
            'availability.status' => 'in:Enabled,Disabled,Draft',
            'availability.trailer_parking_space' => 'required|integer|min:0',
            'availability.avl_deal' => 'required|in:Sale,Lease',
            'availability.fire_protection_system' => [
                'nullable',
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
            'availability.sqftToM2' => 'boolean',
            'availability.yrToMo' => 'boolean',
            'availability.has_tis_hvac'           => 'boolean',
            'availability.has_tis_crane'          => 'boolean',
            'availability.has_tis_rail_spur'      => 'boolean',
            'availability.has_tis_sprinklers'     => 'boolean',
            'availability.has_tis_crossdock'      => 'boolean',
            'availability.has_tis_office'         => 'boolean',
            'availability.has_tis_leed'           => 'boolean',
            'availability.has_tis_land_expansion' => 'boolean',
            'availability.size_sf' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    $building = null;

                    $buildingId = $this->input('building.id');

                    if ($buildingId) {
                        $building = Building::find($buildingId);
                    }

                    if (!$building) {
                        return;
                    }

                    if ($value > $building->building_size_sf) {
                        return $fail(__('The size_sf of buildings_available must be less than or equal to the building_size_sf of buildings.'));
                    }

                    $totalAbsorbed = BuildingAvailable::where('building_id', $building->id)->sum('size_sf');

                    if (($totalAbsorbed + $value) > $building->building_size_sf) {
                        return $fail(__('The total sum of size_sf for all availability records must be less than or equal to the building_size_sf of buildings.'));
                    }
                },
            ],

        ];
    }

    protected function prepareForValidation()
    {
        $building = $this->input('building', []);

        $building['expansion_up_to_sf'] = $building['expansion_up_to_sf'] ?? 0;
        $building['building_size_sf'] = $building['building_size_sf'] ?? 0;
        $building['clear_height_ft'] = $building['clear_height_ft'] ?? 0;
        $building['total_land_sf'] = $building['total_land_sf'] ?? 0;
        $building['skylights_sf'] = $building['skylights_sf'] ?? 0;
        $building['coverage'] = $building['coverage'] ?? 0;
        $building['columns_spacing_ft'] = $building['columns_spacing_ft'] ?? 0;
        $building['floor_thickness_in'] = $building['floor_thickness_in'] ?? 0;
        $building['floor_resistance'] = $building['floor_resistance'] ?? 0;

        $this->merge([
            'building' => $building,
        ]);
    }
}
