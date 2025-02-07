<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvertToAbsorptionRequest extends FormRequest
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
            'size_sf' => 'required|integer|min:0',
            'dock_doors' => 'nullable|integer|min:0',
            'rams' => 'nullable|integer|min:0',
            'truck_court_ft' => 'nullable|integer|min:0',
            'shared_truck' => 'nullable|boolean',
            'new_construction' => 'nullable|boolean',
            'is_starting_construction' => 'nullable|boolean',
            'bay_size' => 'nullable|string|max:45',
            'parking_space' => 'nullable|integer|min:0',
            'trailer_parking_space' => 'nullable|integer|min:0',
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
            'above_market_tis' => [
                'nullable',
                'array',
                function ($attribute, $value, $fail) {
                    $allowedValues = ['HVAC', 'CRANE', 'Rail Spur', 'Sprinklers', 'Crossdock', 'Office', 'Leed', 'Land Expansion'];

                    foreach ($value as $item) {
                        if (!in_array($item, $allowedValues)) {
                            return $fail(__('Invalid value in above_market_tis.'));
                        }
                    }
                }
            ],
            'abs_tenant_id' => 'required|integer|exists:cat_tenants,id',
            'abs_industry_id' => 'required|integer|exists:cat_industries,id',
            'abs_country_id' => 'required|integer|exists:countries,id',
            'abs_lease_term_month' => 'nullable|integer|min:0',
            'abs_closing_rate' => 'required|numeric|min:0',
            'abs_closing_date' => 'nullable|date',
            'abs_company_type' => 'nullable|in:Existing Company,New Company in Market,New Company in Mexico',
            'abs_lease_up' => 'nullable|date',
            'abs_month' => 'nullable|date',
            'abs_sale_price' => 'nullable|numeric|min:0',
            'abs_final_use' => 'nullable|in:Logistic,Manufacturing',
            'abs_building_phase' => 'required|in:BTS,Expansion,Inventory',
            'abs_broker_id' => 'nullable|exists:cat_brokers,id',
            'abs_shelter_id' => 'nullable|exists:cat_shelters,id',
        ];
    }
}
