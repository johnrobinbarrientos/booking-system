<?php

namespace App\Models;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'project_name',
        'project_notes',
        'project_order_number',
    ];
    
    public function worker()
    {
        return $this->belongsToMany(Worker::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function addresses()
    {
        return $this->hasMany(ProjectAddress::class);
    }

    public function contacts()
    {
        return $this->hasMany(ProjectContact::class);
    }
    
    public function primaryContact()
    {
        return $this->contacts()->where('is_primary', 1)->first();
    }
}
