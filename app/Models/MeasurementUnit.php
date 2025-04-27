<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MeasurementUnit extends Model
{
    use HasUuids;
    
    protected $table = 'measurement_units';

    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'name'
    ];
}
