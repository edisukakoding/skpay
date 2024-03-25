<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'meter_number', 'installation_date', 'brand', 'meter_type', 'location', 'remarks', 'rate_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }
}