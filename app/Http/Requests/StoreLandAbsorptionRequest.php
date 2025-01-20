<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLandAbsorptionRequest extends FormRequest
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
            'abs_company_id' => 'required|integer|exists:companies,id',
            'abs_country_id' => 'required|integer|exists:countries,id',
            'abs_broker_id' => 'required|integer|exists:cat_developers,id',
            'land_condition' => 'nullable|in:Fully Developed,Undeveloped',
            'abs_size_HA' => 'required|integer',
            'abs_quarter' => 'required|integer',
            'abs_year' => 'required|integer',
            'abs_closing_price' => 'required|numeric',
            'abs_type_buyer' => 'nullable|in:User,Developer',
            'abs_company_type' => 'nullable|in:Existing Company,New Company in Market,New Company in Mexico',
            'comments' => 'nullable|string|max:45',
        ];
    }
}
