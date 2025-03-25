<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuildingRequest extends FormRequest
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
            'region_id' => 'required|integer|exists:cat_regions,id',
            'market_id' => 'required|integer|exists:cat_markets,id',
            'sub_market_id' => 'required|integer|exists:cat_sub_markets,id',
            'builder_id' => 'required|integer|exists:cat_developers,id',
            'industrial_park_id' => 'required|integer|exists:industrial_parks,id',
            'developer_id' => 'required|integer|exists:cat_developers,id',
            'owner_id' => 'required|integer|exists:cat_developers,id',
            'building_id' => 'nullable|integer|exists:buildings,id',
            'building_name' => 'required|string|max:255',
            'building_size_sf' => 'required|integer',
            'latitud' => 'required|string|max:45',
            'longitud' => 'required|string|max:45',
            'year_built' => 'nullable|integer',
            'clear_height_ft' => 'nullable|integer|max:99',
            'total_land_sf' => 'nullable|numeric|min:0|max:999999999999999999',
            'hvac_production_area' => 'nullable|string|max:45',
            'ventilation' => 'nullable|string|max:45',
            'roof_system' => 'nullable|string|max:45',
            'skylights_sf' => 'nullable|string|max:45',
            'coverage' => 'nullable|string|max:45',
            'transformer_capacity' => 'nullable|string|max:20',
            'expansion_land' => 'integer',
            'class' => 'required|in:A,B,C',
            'generation' => 'required|in:1st Generation,2nd Generation',
            'currency' => 'required|in:USD,MXP',
            'tenancy' => 'required|in:Single,Multitenant',
            'construction_type' => 'nullable|in:TILT_UP,Precast,Block & Sheet Metal,Sheet Metal',
            'lightning' => 'nullable|in:LED,T5,Metal Halide',
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
            'deal' => 'required|in:Sale,Lease',
            'loading_door' => 'nullable|in:Crossdock,Back Loading,Front Loading',
            'building_type' => 'required|in:Spec,BTS,BTS Expansion,Expansion',
            'certifications' => 'required|in:No,LEED,EDGE,BOMA',
            'owner_type' => 'required|in:Investor,REITS,Developer,User Owner,Builder,Private Owner',
            'stage' => 'required|in:Availability,Construction,Leased,Sold',
            'status' => 'required|in:Enabled,Disabled,Pending,Draft',
            'columns_spacing_ft' => 'string|max:20',
            'bay_size' => 'string|max:20',
            'floor_thickness_in' => 'required|integer|min:0',
            'floor_resistance' => 'required|string|max:255',
            'expansion_up_to_sf' => 'required|integer|min:0',
            'sqftToM2' => 'boolean',
            'files' => 'nullable|array',
            'files.*' => 'file|max:10240',
            'type' => 'nullable|string',
        ];

    }
}
