<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexContactRequest extends FormRequest
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
            'search' => 'nullable|string',
            'name' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'comments' => 'nullable|string',

            'is_direct_contact' => 'nullable|boolean',
            'is_land_contact' => 'nullable|boolean',
            'is_buildings_contact' => 'nullable|boolean',
            'is_broker_contact' => 'nullable|boolean',
            'is_developer_contact' => 'nullable|boolean',
            'is_owner_contact' => 'nullable|boolean',
            'is_company_contact' => 'nullable|boolean',

            'not_building_id' => 'nullable|integer',
            'not_land_id' => 'nullable|integer',
            'not_company_id' => 'nullable|integer',

            'page' => 'nullable|integer',
            'size' => 'nullable|integer',
            'column' => 'nullable|in:id,name,email,phone,comments,is_direct_contact,is_land_contact,is_buildings_contact,is_broker_contact,is_developer_contact,is_owner_contact,is_company_contact',
            'state' => 'nullable|in:asc,desc',
        ];
    }
}
