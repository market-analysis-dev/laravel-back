<?php

namespace App\Http\Requests;

use App\Models\BuildingContact;
use Illuminate\Foundation\Http\FormRequest;

class AddBuildingContactRequest extends FormRequest
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
        ];
    }

    public function withValidator($validator)
    {
        $building = $this->route('building');
        $contact = $this->route('contact');

        $validator->after(function ($validator) use ($building, $contact) {
            if (BuildingContact::where('building_id', $building->id)
                ->where('contact_id', $contact->id)
                ->exists()
            ) {
                $validator->errors()->add('contact_id', 'This contact is already linked to the building.');
            }
        });
    }
}
