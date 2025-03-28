<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarketRequest extends FormRequest
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
            'region_id' => ['required', 'exists:cat_regions,id'],
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:cat_markets,name,' . $this->route('cat_market'),
            ],
            'status' => ['required', 'in:active,inactive'],
        ];
    }
}
