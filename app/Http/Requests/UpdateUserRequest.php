<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'middle_name' => 'sometimes|string|max:255',
            'las_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $this->user->id,
            'user_name' => 'sometimes|string|unique:users,user_name,' . $this->user->id,
            'password' => 'sometimes|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
            'total_devices' => 'nullable|integer|min:0',
            'status' => 'nullable|in:Active,Inactive',
            'updated_by' => 'nullable|exists:users,id',
        ];
    }
}
