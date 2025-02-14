<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
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
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('contacts', 'contact_email')->whereNull('deleted_at')
            ],
            'contact_comments' => 'nullable|string|max:255',
            'is_direct_contact' => 'nullable|boolean',
            'is_land_contact' => 'nullable|boolean',
            'is_buildings_contact' => 'nullable|boolean',
            'is_broker_contact' => 'nullable|boolean',
            'is_developer_contact' => 'nullable|boolean',
            'is_owner_contact' => 'nullable|boolean',
            'is_company_contact' => 'nullable|boolean',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
            'deleted_by' => 'nullable|integer',
        ];
    }
}
