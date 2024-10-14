<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'address',
        'phone',
        'email',
        'block',
        'status',
        'remarks',
        'customer_type',
        'group',
        'rt'
    ];

    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }

    public function meters()
    {
        return $this->hasMany(Meter::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'block', 'block');
    }
}
