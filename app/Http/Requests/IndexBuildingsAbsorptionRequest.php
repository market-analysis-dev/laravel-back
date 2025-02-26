<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexBuildingsAbsorptionRequest extends FormRequest
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
            'search' => 'nullable',

            'tenantName' => 'nullable',
            'industryName' => 'nullable',
            'abs_lease_term_month' => 'nullable',
            'abs_closing_date' => 'nullable',
            'abs_final_use' => 'nullable',
            'abs_sale_price' => 'nullable',

            'column' => 'nullable|in:tenantName,industryName,abs_lease_term_month,abs_closing_date,abs_final_use,abs_sale_price',
            'state' => 'nullable|in:asc,desc',
        ];
    }
}
