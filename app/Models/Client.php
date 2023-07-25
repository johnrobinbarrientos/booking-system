<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name',
        'address',
        'abn',
        'client_number',
        'needs_order_number',
        'bad_credit',
        'client_notes'
    ];

    public $sortable = ['name', 'abn'];

    public function project()
    {
        return $this->belongsToMany(Project::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function primaryContact()
    {
        return $this->contacts()->where('is_primary', 1)->first();
    }
}
