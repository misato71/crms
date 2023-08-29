<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidCustomer;

class UpdateLeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * リード情報の編集機能　バリデーション
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'lead_name' => ['required', 'string', 'max:50'],
            'status' => ['nullable', 'integer'],
            'lead_company' => ['nullable', 'integer', new ValidCustomer],
        ];
    }
}
