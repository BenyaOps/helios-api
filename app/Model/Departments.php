<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $fillable = [
        'name', 'nivel', 'employees_quantity', 'ambassador_id'
    ];
}
