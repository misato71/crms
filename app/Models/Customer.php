<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    const CREATED_AT = 'modified_date';
    const UPDATED_AT = 'modified_date';

}
