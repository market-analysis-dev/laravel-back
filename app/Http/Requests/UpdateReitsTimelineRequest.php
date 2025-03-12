<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReitsTimelineRequest extends FormRequest
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
            'reit_id' => 'required|exists:cat_reits,id|integer',
            'name' => 'required|string|max:100',
            'type' => 'required|in:initial,buys,contract,development,expansion,opening,sale,land,canceled',
            'property' => 'required|integer|min:0|max:65535',
        ];
    }
}
