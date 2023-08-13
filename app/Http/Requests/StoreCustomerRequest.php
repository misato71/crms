<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'customer_company_name' => ['required', 'string', 'max:50'],
            'customer_manager_name' => ['nullable', 'string', 'max:50'],
            'customer_type' => ['nullable', 'string', 'max:50'],
            'customer_email' => ['required', 'email', 'max:100'],
            'customer_phone' => ['nullable', 'string', 'max:20'],
            'customer_address' => ['nullable', 'string', 'max:200'],
            'our_manager' => ['nullable', 'integer'],
        ];
    }
}
