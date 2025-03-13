<?php

namespace App\Http\Requests;

use App\Models\CompanyContact;
use Illuminate\Foundation\Http\FormRequest;

class AddCompanyContactRequest extends FormRequest
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
            //
        ];
    }

    public function withValidator($validator)
    {
        $company = $this->route('company');
        $contact = $this->route('contact');

        $validator->after(function ($validator) use ($company, $contact) {
            if (CompanyContact::where('company_id', $company->id)
                ->where('contact_id', $contact->id)
                ->exists()
            ) {
                $validator->errors()->add('contact_id', 'This contact is already linked to the company.');
            }
        });
    }
}
