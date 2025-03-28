<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubmarketRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:100'],
            'market_id' => ['sometimes', 'exists:cat_markets,id'],
            'status' => ['sometimes', 'in:active,inactive'],
            'latitude' => 'nullable|string|max:20|regex:/^-?\d{1,2}\.\d+$/',
            'longitude' => 'nullable|string|max:20|regex:/^-?\d{1,3}\.\d+$/',
        ];
    }
}
