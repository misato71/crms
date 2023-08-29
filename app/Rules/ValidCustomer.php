<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Customer;

class ValidCustomer implements ValidationRule
{
    /**
     * 顧客情報の顧客IDと入力された顧客IDが存在するか確認
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $bool = Customer::where('customer_id', $value)->exists();
        if (!$bool) {
            $fail('指定された顧客IDが存在しません。');
        }    }

}
