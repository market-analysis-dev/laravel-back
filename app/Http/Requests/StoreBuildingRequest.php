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
            'developer_id' => 'nullable|integer|exists:cat_developers,id',
            'owner_id' => 'nullable|integer|exists:cat_developers,id',
            'building_name' => 'required|string|max:255',
            'building_size_sf' => 'required|integer',
            'latitud' => 'nullable|string|max:45',
            'longitud' => 'nullable|string|max:45',
            'year_built' => 'nullable|integer',
            'clear_height_ft' => 'required|integer|max:99',
            'total_land_sf' => 'required|integer|min:0|max:999999999999999999',
            'hvac_production_area' => 'nullable|string|max:45',
            'ventilation' => 'nullable|string|max:45',
            'roofing' => 'nullable|in:Butler,KR18,KR24,SSR LOK,TPO',
            'skylights_sf' => 'required|string|max:45',
            'coverage' => 'required|string|max:45',
            'transformer_capacity' => 'nullable|string|max:20',
            'expansion_land' => 'nullable|boolean',
            'columns_spacing_ft' => 'required|string|max:20',
            'floor_thickness_in' => 'required|integer|min:0',
            'floor_resistance' => 'required|string|max:255',
            'expansion_up_to_sf' => 'required|integer|min:0',
            'class' => 'required|in:A,B,C',
            'generation' => 'required|in:1st Generation,2nd Generation',
            'currency' => 'required|in:USD,MXP',
            'tenancy' => 'required|in:Single,Multitenant',
            'construction_type' => 'nullable|in:Precast,Tiltup,Concrete Masonry & Metal Sheet,Hebel,Concrete Masonry,Metal Sheet',
            'lightning' => 'nullable|in:LED,T5,T8,Metal Halide,None',
            'loading_door' => 'nullable|in:Crossdock,Back Loading,Front Loading',
            'building_type' => 'required|in:Spec,BTS,BTS Expansion,Expansion',
            'certifications' => 'required|in:None,LEED,EDGE,BOMA',
            'owner_type' => 'required|in:Investor,REITS,Developer,User Owner,Builder,Private Owner',
            'stage' => 'required|in:Availability,Construction,Leased,Sold',
            'sqftToM2' => 'boolean',
            'files' => 'nullable|array',
            'files.*' => 'file|max:10240',
            'type' => 'nullable|string',
        ];

    }

    protected function prepareForValidation()
    {
        $this->merge([
            'expansion_up_to_sf' => $this->input('expansion_up_to_sf', 0),
            'building_size_sf' => $this->input('building_size_sf', 0),
            'clear_height_ft' => $this->input('clear_height_ft', 0),
            'total_land_sf' => $this->input('total_land_sf', 0),
            'skylights_sf' => $this->input('skylights_sf', 0),
            'coverage' => $this->input('coverage', 0),
            'columns_spacing_ft' => $this->input('columns_spacing_ft', 0),
            'floor_thickness_in' => $this->input('floor_thickness_in', 0),
            'floor_resistance' => $this->input('floor_resistance', 0),
        ]);
    }

}
