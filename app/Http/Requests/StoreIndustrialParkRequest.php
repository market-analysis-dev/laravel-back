<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIndustrialParkRequest extends FormRequest
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
                'max:255',
                'unique:cat_industrial_parks,name,NULL,id,deleted_at,NULL'
            ],
            'market_id' => [
                'required',
                'exists:cat_markets,id,deleted_at,NULL',
            ],
            'submarket_id' => [
                'required',
                'exists:cat_submarkets,id,deleted_at,NULL',
            ],
        ];
    }
}
