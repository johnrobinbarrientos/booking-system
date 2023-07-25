<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pump extends Model
{
    use HasFactory, Sortable;
    
    protected $fillable = ['pump_name', 'plant_number', 'registration', 'location','year','make','model',
    'concrete_pumped_opening_balance', 'serial_no','worksafe_no','status','notes', 'pump_docket_number'];

    public $sortable = ['pump_name'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function sumCubicMetres()
    {
        return $this->hasMany(SumCubicMetre::class);
    }

    public function pumpMake()
    {
        return $this->belongsTo(PumpMake::class);
    }
}
