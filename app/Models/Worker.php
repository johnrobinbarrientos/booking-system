<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Worker extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name', 'contact_number', 'email', 'date_of_birth','driving_license','driving_license_expiry','hr_license','hr_license_expiry',
    'white_card','roles', 'emergency_contact_name','emergency_contact_number','start_date','finish_date','employment_type','status','notes'];


    public function project()
    {
        return $this->belongsToMany(Project::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }

    public function workerRoles(){

        return $this->belongsToMany(WorkerRole::class, 'worker_role_worker')->withTimestamps();
    }
}
