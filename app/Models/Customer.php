<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


     /**
     * customer_id　主キーを指定
     */
    protected $primaryKey = 'customer_id';


     /**
     * タイプスタンプを更新日時カラムに保存
     *
     * @param timestamp CREATED_AT 
     * @param timestamp UPDATED_AT 
     */
    const CREATED_AT = 'modified_date';
    const UPDATED_AT = 'modified_date';

    /**
     * 顧客情報　customersテーブルから取得
     * 検索BOXに入力されたデータと一致する顧客情報を取得
     * @var array<int, string>
     */
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
     * 顧客情報　新規登録
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
