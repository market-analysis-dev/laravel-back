<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBuildingsAbsorptionRequest extends FormRequest
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
            'dock_doors' => 'nullable|integer|min:0',
            'abs_tenant_id' => 'required|integer|exists:cat_tenants,id',
            'abs_industry_id' => 'required|integer|exists:cat_industries,id',
            'abs_country_id' => 'required|integer|exists:countries,id',
            'broker_id' => 'required|integer|exists:cat_brokers,id',
            'rams' => 'nullable|integer|min:0',
            'truck_court_ft' => 'nullable|integer|min:0',
            'shared_truck' => 'nullable|boolean',
            'new_construction' => 'nullable|boolean',
            'is_starting_construction' => 'nullable|boolean',
            'bay_size' => 'nullable|string|max:45',
            'columns_spacing' => 'nullable|string|max:45',
            'abs_lease_term_month' => 'nullable|integer|min:0',
            'parking_space' => 'nullable|integer|min:0',
            'abs_closing_rate' => 'required|numeric|min:0',
            'abs_closing_date' => 'nullable|date',
            'abs_lease_up' => 'nullable|date',
            'abs_month' => 'nullable|date',
            'abs_sale_price' => 'nullable|numeric|min:0',
            'created_by' => 'nullable|integer|exists:users,id',
            'updated_by' => 'nullable|integer|exists:users,id',
            'abs_building_phase' => 'required|in:BTS,Expansion,Inventory',
            'abs_final_use' => 'nullable|in:Logistic,Manufacturing',
            'abs_company_type' => 'nullable|in:Existing Company,New Company in Market,New Company in Mexico',
            'size_sf' => 'required|integer|min:0',
            'trailer_parking_space' => 'nullable|integer|min:0',
            'fire_protection_system' => 'required|in:Hose Station,Sprinkler,Extinguisher',
            'above_market_tis' => 'nullable|in:HVAC,CRANE,Rail Spur,Sprinklers,Crossdock,Office,Leed,Land Expansion',
            'abs_deal' =>'required|in:Sale,Lease',
            'abs_broker_id' => 'nullable|exists:cat_brokers,id',
            'abs_shelter_id' => 'nullable|exists:cat_shelters,id',
            'sqftToM2' => 'boolean',
        ];
    }
}
