<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexLocationRequest extends FormRequest
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
            'region_id' => 'nullable|integer|exists:cat_regions,id',
            'market_id' => 'nullable|integer|exists:cat_markets,id',
            'sub_market_id' => 'nullable|integer|exists:cat_sub_markets,id',
            'developer_id' => 'nullable|integer|exists:cat_developers,id',
            'industrial_park_id' => 'nullable|integer|exists:industrial_parks,id',
            'building_id' => 'nullable|integer|exists:buildings,id',
        ];
    }
}
