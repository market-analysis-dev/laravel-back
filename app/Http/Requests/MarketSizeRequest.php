<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarketSizeRequest extends FormRequest
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
            'page' => 'nullable|integer',
            'size' => 'nullable|integer',
            'search' => 'nullable|string',
            'building_name' => 'nullable|string',
            'market' => 'nullable|string',
            'submarket' => 'nullable|string',
            'industrial_park' => 'nullable|string',
            'column' => 'nullable|in:status,building_name,market,submarket,industrial_park',
            'state' => 'nullable|in:asc,desc',
            'region_id' => 'nullable|integer|exists:cat_regions,id',
            'market_id' => 'nullable|integer|exists:cat_markets,id',
            'sub_market_id' => 'nullable|integer|exists:cat_sub_markets,id',
            'developer_id' => 'nullable|integer|exists:cat_developers,id',

            'owner' => 'nullable|string',
            'building_size_sf' => 'nullable|numeric',
            'construction_size_sf' => 'nullable|numeric',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'year_built' => 'nullable|integer',
            'clear_height_ft' => 'nullable|numeric',
            'total_land_sf' => 'nullable|numeric',
            'hvac_production_area' => 'nullable|string',
            'ventilation' => 'nullable|string',
            'roofing' => 'nullable|string',
            'skylights_sf' => 'nullable|numeric',
            'coverage' => 'nullable|string',
            'transformer_capacity' => 'nullable|string',
            'expansion_land' => 'nullable|string',
            'columns_spacing_ft' => 'nullable|numeric',
            'floor_thickness_in' => 'nullable|numeric',
            'floor_resistance' => 'nullable|string',
            'expansion_up_to_sf' => 'nullable|numeric',
            'class' => 'nullable|string',
            'generation' => 'nullable|string',
            'currency' => 'nullable|string',
            'tenancy' => 'nullable|string',
            'construction_type' => 'nullable|string',
            'lightning' => 'nullable|string',
            'loading_door' => 'nullable|string',
            'building_type' => 'nullable|string',
            'certifications' => 'nullable|string',
            'owner_type' => 'nullable|string',
            'status' => 'nullable|string',
            'type_avl' => 'nullable|string',
            'type_abs' => 'nullable|string',
            'tenant' => 'nullable|string',
            'avl_size_sf' => 'nullable|numeric',
            'avl_minimum_space_sf' => 'nullable|numeric',
            'offices_space_sf' => 'nullable|string',
            'dock_doors' => 'nullable|string',
            'ramps' => 'nullable|string',
            'kvas_fees_paid' => 'nullable|string',
            'fire_protection_system' => 'nullable|string',
            'deal' => 'nullable|string',
            'avl_month' => 'nullable|string',
            'avl_quarter' => 'nullable|string',
            'avl_year' => 'nullable|string',
            'abs_closing_month' => 'nullable|string',
            'abs_closing_quarter' => 'nullable|string',
            'abs_closing_year' => 'nullable|string',
            'abs_industry' => 'nullable|string',
            'abs_final_use' => 'nullable|string',
            'abs_country' => 'nullable|string',
            'abs_closing_currency' => 'nullable|string',
            'abs_company_type' => 'nullable|string',
            'has_tis_hvac' => 'nullable|string',
            'has_tis_office' => 'nullable|string',
            'has_tis_crane' => 'nullable|string',
            'has_tis_rail_spur' => 'nullable|string',
            'has_tis_sprinklers' => 'nullable|string',
            'has_tis_crossdock' => 'nullable|string',
            'has_tis_leed' => 'nullable|string',
            'has_tis_land_expansion' => 'nullable|string',
            'is_new_construction' => 'nullable|string',
            'is_starting_construction' => 'nullable|string',
        ];
    }
}
