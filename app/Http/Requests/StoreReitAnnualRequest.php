<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReitAnnualRequest extends FormRequest
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
            'reit_id' => 'required|exists:cat_reits,id',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'quarter' => 'nullable|string|in:Q1,Q2,Q3,Q4',
            'noi' => 'required|numeric|min:0|max:999999.99',
            'cap_rate' => 'required|numeric|min:0|max:99.99',
            'occupancy' => 'required|numeric|min:0|max:100',
            'm2' => 'nullable|integer|min:0',
            'sqft' => 'required|numeric|min:0|max:9999999999.99',
            'buildings' => 'required|integer|min:0',
            'customer_retention_rate' => 'required|numeric|min:0|max:100',
            'average_rent' => 'required|numeric|min:0|max:999999.99',
            'contracts' => 'required|numeric|min:0|max:99.99',
            'rental_income' => 'required|numeric|min:0|max:99999999.99',
            'dolar' => 'required|numeric|min:0|max:99999.99',
            'prop_investment' => 'required|numeric|min:0|max:99999999.99',
            'type' => 'required|in:annual,quarter',
        ];
    }
}
