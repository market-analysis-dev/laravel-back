<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexReitAnnualRequest extends FormRequest
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

            'type' => 'nullable|string',
            'reit_id' => 'nullable|string',
            'reitName' => 'nullable|string',
            'year' => 'nullable|string',
            'quarter' => 'nullable|string',
            'noi' => 'nullable|string',
            'cap_rate' => 'nullable|string',
            'occupancy' => 'nullable|string',
            'sqft' => 'nullable|string',

            'column' => 'nullable|in:reit_id,year,quarter,type,noi,cap_rate,occupancy,sqft,reitName',
            'state' => 'nullable|in:asc,desc',
        ];
    }
}
