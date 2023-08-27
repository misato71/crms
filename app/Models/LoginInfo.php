<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class LoginInfo extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


     /**
     * login_infos テーブル名を指定
     * login_id　主キーを指定
     */
    protected $table = 'login_infos';
    protected $primaryKey = 'login_id';


     /**
     * タイプスタンプを更新日時カラムに保存
     *
     * @param timestamp CREATED_AT 
     * @param timestamp UPDATED_AT 
     */
    const CREATED_AT = 'modified_date';
    const UPDATED_AT = 'modified_date';


     /**
     * パスワードカラムを指定
     *
     */
    public function getAuthPassword()
    {
        return $this->staff_password;
    }


     /**
     * ログイン情報を新規登録
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'staff_password',
        'created_id',
        'modified_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'staff_password',
    ];

}
