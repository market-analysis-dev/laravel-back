<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCamRequest extends FormRequest
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
            'industrial_park_id' => ['required', 'exists:cat_industrial_parks,id'],
            'developer_id' => ['required', 'exists:cat_developers,id'],
            'region_id' => ['required', 'exists:cat_regions,id'],
            'market_id' => ['required', 'exists:cat_markets,id'],
            'submarket_id' => ['required', 'exists:cat_submarkets,id'],
            'cam_building_sf' => ['required', 'numeric', 'between:0,999.99'],
            'cam_land_sf' => ['required', 'numeric', 'between:0,999.99'],
            'has_cam_services' => ['required', 'boolean'],
            'has_lightning_maintenance' => ['required', 'boolean'],
            'has_park_administration' => ['required', 'boolean'],
            'storm_sewer_maintenance' => ['required', 'boolean'],
            'has_survelliance' => ['required', 'boolean'],
            'has_management_fee' => ['required', 'boolean'],
            'currency' => ['required', 'in:USD,MXP'],
            'latitude'=> ['required', 'string', 'max:20'],
            'longitude'=> ['required', 'string', 'max:20'],
        ];
    }
}
