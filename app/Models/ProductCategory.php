<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasUuids;

    protected $table = 'product_category';

    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'product_id',
        'category_id'
    ];
}
