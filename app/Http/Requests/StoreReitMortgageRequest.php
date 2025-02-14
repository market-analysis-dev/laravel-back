<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReitMortgageRequest extends FormRequest
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
            'reit_id' => 'required|exists:cat_reits,id',
            'reit_type_id' => 'required|exists:cat_reit_types,id',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'quarter' => 'nullable|string|size:2',
            'net_income' => 'required|numeric|between:0,999.99',
            'return_on_enquity' => 'required|numeric|between:0,99.99',
            'return_on_assets' => 'required|numeric|between:0,99.99',
            'return_on_invested_capital' => 'required|numeric|between:0,99.99',
            'interest_income' => 'required|numeric|between:0,99999999.99',
            'number_loans' => 'required|numeric|between:0,99999999.99',
            'outstanding_portfolio' => 'required|numeric|between:0,999.99',
            'overdue_portfolio' => 'required|numeric|between:0,999.99',
            'avg_interest_rate_fovisste' => 'required|numeric|between:0,99.99',
            'avg_interest_rate_pdh' => 'required|numeric|between:0,99.99',
            'dollar' => 'required|numeric|between:0,999.99',
            'divided_yield' => 'required|numeric|between:0,99.99',
            'total_portfolio' => 'required|numeric|between:0,99999999.99',
        ];
    }
}
