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
        return [
            'page' => 'nullable|integer',
            'page_size' => 'nullable|integer',
            'sort' => 'nullable|in:asc,desc',
            'sort_column' => 'nullable|in:building_name,building_class,market,sub_market,industrial_park,developer,avl_type',
            'search' => 'nullable',

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
