<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountModel extends Model
{
    use HasFactory;

    protected $table = 'discounts';
    protected $fillable = [
        'shop_id',
        'discount_name',
        'discount_code',
        'discount_total',
        'start_date',
        'end_date',
        'created_by',
        'updated_by'
    ];
}
