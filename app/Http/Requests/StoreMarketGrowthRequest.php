<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarketGrowthRequest extends FormRequest
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
            'building_id' => 'required|exists:buildings,id',
            'owner_id' => 'required|exists:cat_developers,id',
            'developer_id' => 'required|exists:cat_developers,id',
            'builder_id' => 'required|exists:cat_developers,id',
            'industrial_park_id' => 'required|exists:industrial_parks,id',
            'region_id' => 'required|exists:cat_regions,id',
            'market_id' => 'required|exists:cat_markets,id',
            'sub_market_id' => 'required|exists:cat_sub_markets,id',

            'size_sf' => 'required|integer|min:1',

            'deal' => 'required|in:Sale,Lease',
            'type' => 'required|in:BTS,Expansion,Inventory',

            'start_date' => 'required|date|before_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',

            'comments' => 'nullable|string|max:255',

            'latitude' => 'nullable|string|max:20|regex:/^-?\d{1,2}\.\d+$/',
            'longitude' => 'nullable|string|max:20|regex:/^-?\d{1,3}\.\d+$/',
        ];
    }
}
