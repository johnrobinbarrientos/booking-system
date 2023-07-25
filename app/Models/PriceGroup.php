<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceGroup extends Model
{
    use HasFactory;
    
    protected $fillable = ['location_name','additional_man_per_hour','overtime_per_hour_per_man',
    'offsite_clean_out','cement_bag','pipeline_extension','washout_bag','travel'];

    public function PumpPrice(){
        return $this->belongsTo(PumpPrice::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
