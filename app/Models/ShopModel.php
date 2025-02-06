<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopModel extends Model
{
    use HasFactory;
    protected $table = 'shop';

    protected $fillable = [
        'user_id',
        'shop_name',
        'shop_code',
        'owner_name',
        'shop_logo',
        'created_by',
        'updated_by'
    ];
}
