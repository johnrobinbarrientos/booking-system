<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    public function booking()
    {
        return $this->morphTo(Booking::class);
    }

    public function pumpPrice()
    {
        return $this->morphTo(PumpPrice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
