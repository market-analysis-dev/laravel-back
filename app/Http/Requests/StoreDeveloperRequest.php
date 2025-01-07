<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDeveloperRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('cat_developers', 'name')->whereNull('deleted_at'),
            ],
            'is_developer' => 'required|boolean',
            'is_builder' => 'required|boolean',
            'is_owner' => 'required|boolean',
            'is_user_owner' => 'required|boolean',
        ];
    }
}
