<?php

namespace App\Models;

use App\Models\ActivityLog;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Kyslik\ColumnSortable\Sortable;

class PumpPrice extends Model{
    use HasFactory, LogsActivity, Sortable;
    
    protected $fillable = ['price_group_id','pump_category_id','size','min_hire_first_2_hours_on_site','extra_time_per_hour','per_cube_meter_of_concrete', 'user_id'];

    public $sortable = ['size'];

    public function PriceGroup(){
        return $this->hasOne(PriceGroup::class,'id','price_group_id');
    }

    public function PumpCategory(){
        return $this->hasOne(PumpCategory::class,'id','pump_category_id');
    }

    public function activityLog()
    {
        return $this->morphMany(ActivityLog::class, 'subject');
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['price_group_id','pump_category_id','size','min_hire_first_2_hours_on_site','extra_time_per_hour','per_cube_meter_of_concrete','user_id']);
        // Chain fluent methods for configuration options
    }
}