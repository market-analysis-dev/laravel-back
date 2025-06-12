<?php

namespace App\Http\Requests;

use App\Models\Building;
use App\Models\BuildingAvailable;
use Illuminate\Foundation\Http\FormRequest;

class StoreBuildingWithAbsorptionRequest extends FormRequest
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

            'absorption' => ['nullable', 'array'],
            'absorption.dock_doors' => 'required|integer|min:0',
            'absorption.abs_tenant_id' => 'nullable|integer|exists:cat_tenants,id',
            'absorption.abs_industry_id' => 'nullable|integer|exists:cat_industries,id',
            'absorption.abs_country_id' => 'nullable|integer|exists:countries,id',
            'absorption.broker_id' => 'required|integer|exists:cat_brokers,id',
            'absorption.building_available_id' => 'nullable|integer|exists:buildings_available,id',
            'absorption.construction_size_sf' => 'required|integer|min:0',
            'absorption.ramps' => 'required|integer|min:0',
            'absorption.truck_court_ft' => 'required|integer|min:0',
            'absorption.kvas_fees_paid' => 'nullable|string|max:20',
            'absorption.shared_truck' => 'nullable|boolean',
            'absorption.is_new_construction' => 'nullable|boolean',
            'absorption.is_starting_construction' => 'nullable|boolean',
            'absorption.bay_size' => 'nullable|string|max:45',
            'absorption.abs_lease_term_month' => 'nullable|integer|min:0',
            'absorption.parking_space' => 'required|integer|min:0',
            'absorption.abs_closing_rate' => 'required|numeric|min:0',
            'absorption.abs_closing_date' => 'nullable|date',
            'absorption.abs_lease_up' => 'nullable|date',
            'absorption.abs_month' => 'nullable|string',
            'absorption.abs_sale_price' => 'nullable|numeric|min:0',
            'absorption.created_by' => 'nullable|integer|exists:users,id',
            'absorption.abs_closing_dock_door' => 'required|integer|min:0',
            'absorption.abs_closing_knockout_docks'  => 'required|integer|min:0',
            'absorption.abs_closing_ramps'           => 'required|integer|min:0',
            'absorption.abs_closing_truck_court'     => 'required|integer|min:0',
            'absorption.abs_closing_currency'        => 'required|in:USD,MXP',
            'absorption.knockout_docks' => 'nullable|numeric|min:0',
            'absorption.updated_by' => 'nullable|integer|exists:users,id',
            'absorption.offices_space_sf' => 'required|integer|min:0',
            'absorption.abs_type' => 'nullable|in:Inventory,Inventory Expansion,BTS,BTS Expansion',
            'absorption.abs_final_use' => 'nullable|in:Logistic,Manufacturing,TBD',
            'absorption.abs_company_type' => 'nullable|in:Existing Company,New Company in Market,New Company in Mexico',
            'absorption.status' => 'in:Enabled,Disabled,Draft',
            'absorption.trailer_parking_space' => 'required|integer|min:0',
            'absorption.avl_date' => 'nullable|date',
            'absorption.abs_asking_shell' => 'required|numeric|min:0',
            'absorption.fire_protection_system' => [
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
            'absorption.abs_deal' =>'required|in:Sale,Lease',
            'absorption.abs_shelter_id' => 'nullable|exists:cat_shelters,id',
            'absorption.sqftToM2' => 'boolean',
            'absorption.yrToMo' => 'boolean',
            'absorption.has_tis_hvac'           => 'boolean',
            'absorption.has_tis_crane'          => 'boolean',
            'absorption.has_tis_rail_spur'      => 'boolean',
            'absorption.has_tis_sprinklers'     => 'boolean',
            'absorption.has_tis_crossdock'      => 'boolean',
            'absorption.has_tis_office'         => 'boolean',
            'absorption.has_tis_leed'           => 'boolean',
            'absorption.has_tis_land_expansion' => 'boolean',
            'absorption.size_sf' => [
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

                    $totalAbsorbed = BuildingAvailable::where('building_id', $buildingId)->sum('size_sf');

                    if (($totalAbsorbed + $value) > $building->building_size_sf) {
                        return $fail(__('The total sum of size_sf for all availability/absorption records must be less than or equal to the building_size_sf of buildings.'));
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
