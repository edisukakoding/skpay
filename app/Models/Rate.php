<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'effective_date',
        'fixed_fee',
        'status',
    ];

    public function rateDetails()
    {
        return $this->hasMany(RateDetail::class);
    }
}
