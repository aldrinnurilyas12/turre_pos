<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'shop_id',
        'product_name',
        'category_id',
        'price',
        'stock',
        'product_weight',
        'product_type',
        'color',
        'product_size',
        'images',
        'created_by',
        'updated_by'
    ];
}
