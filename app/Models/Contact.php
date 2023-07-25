<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_name',
        'contact_email',
        'contact_phone',
        'is_primary',
        'status',
        'client_id'
    ]; 

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    

}
