<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexLandRequest extends FormRequest
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
            'page' => 'nullable|integer',
            'size' => 'nullable|integer',
            'search' => 'nullable|string',
            'status' => 'nullable|string',
            'land_name' => 'nullable|string',
            'marketName' => 'nullable|string',
            'submarketName' => 'nullable|string',
            'industrialParkName' => 'nullable|string',
            'column' => 'nullable|in:status,land_name,marketName,submarketName,industrialParkName',
            'state' => 'nullable|in:asc,desc',
        ];
    }
}
