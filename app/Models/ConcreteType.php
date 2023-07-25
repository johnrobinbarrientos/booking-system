<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ConcreteType extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['concrete_type'];

    public $sortable = ['concrete_type'];
}
