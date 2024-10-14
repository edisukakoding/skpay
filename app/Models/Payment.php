<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'payment_date',
        'payment_amount',
        'payment_method',
        'bill_id',
        'remarks',
        'record_date',
        'verification',
        'user_verification_id'
    ];

    protected $casts = [
        'payment_date' => 'datetime'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_verification_id', 'id');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
