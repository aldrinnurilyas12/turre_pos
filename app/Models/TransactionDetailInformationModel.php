<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetailInformationModel extends Model
{
    use HasFactory;

    protected $table = 'transactions_detail_information';
    protected $fillable = [
        'transaction_id',
        'payment_method',
        'promo_code',
        'amount',
        'payment_changes',
        'payment_total',
        'customer',
        'email',
        'created_by',
        'updated_by'
    ];
}
