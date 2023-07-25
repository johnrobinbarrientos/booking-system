<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PumpMake extends Model
{
    use HasFactory;

    protected $fillable = ['make'];

    public function pump(){
        
        return $this->hasOne(Pump::class);
    }
}
