<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexReitMortgageRequest extends FormRequest
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

            'reit_id' => 'nullable|string',
            'reitName' => 'nullable|string',
            'reitTypeName' => 'nullable|string',
            'year' => 'nullable|string',
            'quarter' => 'nullable|string',

            'column' => 'nullable|in:reit_id,year,quarter,reitName,reitTypeName',
            'state' => 'nullable|in:asc,desc',
        ];
    }
}
