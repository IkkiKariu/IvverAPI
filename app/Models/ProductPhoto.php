<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ProductPhoto extends Model
{
    use HasUuids;

    protected $table = 'product_photos';

    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'product_id',
        'path',
        'is_preview'
    ];
}
