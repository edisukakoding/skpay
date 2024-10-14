<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'title',
        'bill_date',
        'due_date',
        'total_amount',
        'late',
        'other_charges',
        'discount',
        'user_id',
        'uuid',
        'status'
    ];

    protected $casts = [
        'bill_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }

    public function billDetails()
    {
        return $this->hasMany(BillDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
