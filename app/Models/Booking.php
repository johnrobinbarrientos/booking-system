<?php

namespace App\Models;

use App\Models\PumpPrice;
use App\Models\Pump;
use App\Models\Client;
use App\Models\ConcreteType;
use App\Models\Worker;
use App\Models\BookingSundries;
use App\Models\ActivityLog;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\HasActivity;
use Kyslik\ColumnSortable\Sortable;


class Booking extends Model
{
    use HasFactory, LogsActivity, Sortable;

    protected $fillable = [
        'booking_number', 'customer_order_number', 'job_date', 'date_booked', 'booking_status', 'job_description', 'job_start_time', 'concrete_time', 'metres_to_pump',
        'concrete_mix', 'job_notes', 'docket_no','pump_docket_number_origin','m3','time_onsite', 'time_offsite','total_hours',
        'metres_pumped', 'cement_bag', 'fuel_levy', 'labour_rate', 'total_labour','travel', 'total_travel', 'washout_bag', 'pipeline_extension', 
        'cost_per_bag', 'total_washout_bag', 'extra_time_per_hour_cost', 'per_cube_meter_of_concrete',
        'gst', 'grand_total', 'client_id', 'contact_id', 'pump_id', 'project_id', 'project_contact_id','project_address_id',
        'concrete_supplier_id','concrete_type_id', 'price_group_id', 'pump_category_id', 'pump_price_id', 'user_id', 'subbie_id','is_subbie_required',
        'booking_from_date', 'booking_to_date', 'is_include_weekend',
        'min_hire','min_hire_rate','min_hire_total','metres_pumped_rate','metres_pumped_total','additional_man_per_hr','overtime_per_hr','overtime_per_hr_rate','overtime_per_hr_total','extra_time',
        'extra_time_rate','extra_time_total','travel_rate','travel_total','washout_bag_rate','washout_bag_total','cement_bag_rate','cement_bag_total',
        'offsite_clean_out','pipeline_extension_rate','pipeline_extension_total','ex_gst',
        'additional_man_per_hr_rate','additional_man_per_hr_total','offsite_clean_out_rate','offsite_clean_out_total',
        'worker_operator_id','worker_hoseman_id','worker_extraman1_id','worker_extraman2_id','worker_extraman3_id','booking_notes','actual_pump_sent',
        'client_none_contact_name','client_none_contact_no','client_none_contact_email','client_none_contact_address',
        'project_none_contact_name','project_none_contact_no','project_none_contact_email','project_none_contact_address',
    ];

    public $sortable = ['job_date',
                        'booking_number',
                        'booking_status',
                        'concrete_time',
                        'metres_to_pump'];

    // protected $appends = array('min_hire', 'extra_time');


    public function clientDetail()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function concreteTypeDetail()
    {
        return $this->hasOne(ConcreteType::class, 'id', 'concrete_type_id');
    }

    public function pumpDetail()
    {
        return $this->hasOne(Pump::class, 'id', 'pump_id');
    }

    public function pumpPriceDetail()
    {
        return $this->hasOne(PumpPrice::class, 'id', 'pump_price_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function projectAddress()
    {
        return $this->belongsTo(ProjectAddress::class);
    }

    public function pump()
    {
        return $this->belongsTo(Pump::class);
    }

    public function worker()
    {
        return $this->belongsToMany(Worker::class, 'booking_worker')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function sundries()
    {
        return $this->hasMany(BookingSundries::class);
    }

    public function subbie()
    {
        return $this->belongsTo(Subbie::class);
    }

    public function PriceGroup()
    {
        return $this->belongsTo(PriceGroup::class);
    }

    public function PumpCategory()
    {
        return $this->belongsTo(PumpCategory::class);
    }

    public function PumpPrice()
    {
        return $this->belongsTo(PumpPrice::class);
    }

    public function concreteType()
    {
        return $this->belongsTo(ConcreteType::class);
    }

    public function sumCubicMetre()
    {
        return $this->hasOne(SumCubicMetre::class);
    }

    public function activityLog()
    {
        return $this->morphMany(ActivityLog::class, 'subject');
    }

    public function duplicate()
    {
        $duplicate = $this->replicate();
        // $duplicate->save();
        return $duplicate;
    }

    const STATUS_COLOR = [
        'Allocated' => '#4299FF',
        'Confirmed' => '#F0DA4A',
        'Shadow Booking' => '#D5D9D4',
        'Canceled' => 'red',
        'Unallocated' => 'white',
        'Complete' => '#5bff42',
        'Jobs To Check' => '#42f9ff',
    ];

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->booking_number = IdGenerator::generate(['table' => 'bookings', 'field' => 'booking_number', 'length' => 9, 'prefix' => 'BK-']);
    //     });
    // }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['booking_status', 'user_id']);
        // Chain fluent methods for configuration options
    }
}
