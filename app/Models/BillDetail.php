<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;

    protected $fillable = ['bill_id', 'meter_id', 'fixed_fee', 'previous_reading', 'current_reading', 'subtotal', 'consumption'];

    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }
}
