<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerRole extends Model
{
    use HasFactory;

    protected $fillable = ['role_name','worker_id'];

    public function workers()
    {
        return $this->belongsToMany(Worker::class);
    }
}
