<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAddress extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'suburb','state','postcode','project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
