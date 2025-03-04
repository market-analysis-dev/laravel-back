<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('contacts', 'email')
                    ->whereNull('deleted_at')
                ->ignore($this->contact->id)
            ],
            'comments' => 'nullable|string|max:255',
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
