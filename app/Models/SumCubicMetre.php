<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumCubicMetre extends Model
{
    use HasFactory;

    protected $fillable = ['total_metres_pumped', 'pump_id'];

    public function pump()
    {
        return $this->belongsTo(Pump::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
