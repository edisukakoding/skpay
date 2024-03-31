<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidtransLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_time',
        'transaction_id',
        'status_message',
        'status_code',
        'signature_key',
        'settlement_time',
        'payment_type',
        'order_id',
        'merchant_id',
        'gross_amount',
        'fraud_status',
        'expiry_time',
        'currency',
        'biller_code',
        'bill_key'
    ];
}
