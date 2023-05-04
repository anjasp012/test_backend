<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "accountId" => ['required', Rule::exists('customers')],
            // "TransactionDate" => ['required'],
            "description" => ['required'],
            "debitCreditStatus" => ['required'],
            "amount" => ['required', 'numeric'],
        ];
    }
}
