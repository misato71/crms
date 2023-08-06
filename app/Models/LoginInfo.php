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

    // テーブル名と主キーを指定
    protected $table = 'login_infos';
    protected $primaryKey = 'login_id';

    // パスワードカラムを指定
    public function getAuthPassword()
    {
        return $this->staff_password;
    }


    const CREATED_AT = 'modified_date';
    const UPDATED_AT = 'modified_date';


     /**
     * The attributes that are mass assignable.
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
