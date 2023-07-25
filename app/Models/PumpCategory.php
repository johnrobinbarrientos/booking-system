<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PumpCategory extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'category_name'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
