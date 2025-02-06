<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'product_category';

    protected $fillable = [
        'shop_id',
        'category_name',
        'created_by',
        'updated_by'
    ];
}