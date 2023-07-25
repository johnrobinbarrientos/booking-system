<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class ClientProject extends Model
{
    use HasFactory;
    protected $table = 'client_project';
}
