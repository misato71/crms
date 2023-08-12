<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    const CREATED_AT = 'modified_date';
    const UPDATED_AT = 'modified_date';

    public function scopeSearchCustomers($query, $input = null)
    {
        if(!empty($input)){
            if(Customer::where('customer_company_name', 'like', '%' . $input . '%' )
            ->orWhere('customer_phone', 'like', '%' . $input . '%')
            ->orWhere('customer_address', 'like', '%' . $input . '%')
            ->orWhere('customer_type', 'like', '%' . $input . '%')->exists())
            {
                return $query->where('customer_company_name', 'like', '%' . $input . '%' )
                ->orWhere('customer_phone', 'like', '%' . $input . '%')
                ->orWhere('customer_address', 'like', '%' . $input . '%')
                ->orWhere('customer_type', 'like', '%' . $input . '%');
            }
        }
    }
}
