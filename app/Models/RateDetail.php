<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateDetail extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'price', 'rate_id', 'threshold_limit'];
}
