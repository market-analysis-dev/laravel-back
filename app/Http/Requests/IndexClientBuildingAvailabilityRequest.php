<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexClientBuildingAvailabilityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'sqftToM2' => filter_var($this->sqftToM2, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'market_id'            => 'array|nullable',
            'market_id.*'          => 'integer|exists:cat_markets,id',

            'sub_market_id'        => 'array|nullable',
            'sub_market_id.*'      => 'integer|exists:cat_sub_markets,id',

            'class'                => 'array|nullable',
            'class.*'              => 'string',

            'avl_type'             => 'array|nullable',
            'avl_type.*'           => 'string',

            'deal'                 => 'array|nullable',
            'deal.*'               => 'string',

            'above_market_tis'     => 'array|nullable',
            'above_market_tis.*'   => 'string',

            'size_sf' => ['nullable', 'array'],
            'size_sf.*' => ['nullable', 'numeric'],


            'region_id'            => 'array|nullable',
            'region_id.*'          => 'integer|exists:cat_regions,id',

            'generation'           => 'array|nullable',
            'generation.*'         => 'string',

            'currency'             => 'array|nullable',
            'currency.*'           => 'string',

            'tenancy'              => 'array|nullable',
            'tenancy.*'            => 'string',

            'building_name'        => 'string|nullable',

            'industrial_park_id'   => 'array|nullable',
            'industrial_park_id.*' => 'integer|exists:industrial_parks,id',

            'shared_truck'         => 'boolean|nullable',

            'loading_door'         => 'array|nullable',
            'loading_door.*'       => 'string',

            'developer_id'         => 'array|nullable',
            'developer_id.*'       => 'integer|exists:cat_developers,id',

            'clear_height_ft' => ['nullable', 'array'],
            'clear_height_ft.*' => ['nullable', 'numeric'],


            'owner_id'             => 'array|nullable',
            'owner_id.*'           => 'integer|exists:cat_developers,id',

            'owner_type'           => 'array|nullable',
            'owner_type.*'         => 'string',

            'latitud'            => 'string|max:20',

            'longitud'            => 'string|max:20',

            'sqftToM2'             => 'boolean|nullable',
        ];
    }
}
