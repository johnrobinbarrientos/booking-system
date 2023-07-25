<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_name',
        'contact_email',
        'contact_phone',
        'is_primary',
        'status',
        'project_id'
    ]; 

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    

}
