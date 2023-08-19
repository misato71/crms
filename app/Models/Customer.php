<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'customer_id';
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

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_company_name',
        'customer_manager_name',
        'customer_type',
        'customer_email',
        'customer_phone',
        'customer_address',
        'our_manager',
        'created_id',
        'modified_id',
    ];

}
