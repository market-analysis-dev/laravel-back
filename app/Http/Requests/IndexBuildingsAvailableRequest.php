<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexBuildingsAvailableRequest extends FormRequest
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
        /*return [
            'page' => 'nullable|integer',
            'size' => 'nullable|integer',
            'search' => 'nullable|string',

            'building_state' => 'nullable|string',
            'avl_size_sf' => 'nullable|string',
            'avl_building_dimensions' => 'nullable|string',
            'avl_minimum_space_sf' => 'required|string',
            'avl_expansion_up_to_sf' => 'nullable|string',
            'dock_doors' => 'required|string',

            'column' => 'nullable|in:building_state,avl_size_sf,avl_building_dimensions,avl_minimum_space_sf,avl_expansion_up_to_sf,dock_doors',
            'state' => 'nullable|in:asc,desc',
        ];*/
        return [
            'page_size' => 'integer|nullable',
            'column' => 'string|nullable',
            'search' => 'string|nullable',
            'avl_type' => 'string|nullable',
            'building_name' => 'string|nullable',
            'building_class' => 'string|nullable',
            'market' => 'string|nullable',
            'sub_market' => 'string|nullable',
            'industrial_park' => 'string|nullable',
            'developer' => 'string|nullable',
        ];
    }
}
