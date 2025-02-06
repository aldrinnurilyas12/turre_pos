<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = [
        'shop_id',
        'product_id',
        'invoice',
        'quantity',
        'total',
        'created_by',
        'updated_by'
    ];
}
