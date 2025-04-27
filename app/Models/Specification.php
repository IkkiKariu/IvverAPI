<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasUuids;

    protected $table = 'specifications';

    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'product_id',
        'name',
        'value'
    ];
}
