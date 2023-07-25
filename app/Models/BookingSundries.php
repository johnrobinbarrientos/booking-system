<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSundries extends Model
{
    use HasFactory;

    protected $table = 'booking_sundries';

    protected $fillable = ['booking_id','sundries','sundries_qty','sundries_rate','sundries_total'];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }
}
