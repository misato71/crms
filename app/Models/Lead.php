<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

     /**
     * lead_id　主キーを指定
     */
    protected $primaryKey = 'lead_id';


     /**
     * タイプスタンプを更新日時カラムに保存
     *
     * @param timestamp CREATED_AT 
     * @param timestamp UPDATED_AT 
     */
    const CREATED_AT = 'modified_date';
    const UPDATED_AT = 'modified_date';

    /**
     * リード情報　leadsテーブルから取得
     * 検索BOXに入力されたデータと一致するリード情報を取得
     * @var array<int, string>
     */
    public function scopeSearchLeads($query, $input = null)
    {
        if(!empty($input)){
            if(Lead::where('lead_name', 'like', '%' . $input . '%' )
            ->orWhere('status', 'like', '%' . $input . '%')
            ->orWhere('lead_company', 'like', '%' . $input . '%')
            ->orWhere('modified_date', 'like', '%' . $input . '%')->exists())
            {
                return $query->where('lead_name', 'like', '%' . $input . '%' )
                ->orWhere('status', 'like', '%' . $input . '%')
                ->orWhere('lead_company', 'like', '%' . $input . '%')
                ->orWhere('modified_date', 'like', '%' . $input . '%');
            }
        }
    }

    /**
     * リード情報　登録
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lead_name',
        'status',
        'lead_company',
        'created_id',
        'modified_id',
    ];

}
