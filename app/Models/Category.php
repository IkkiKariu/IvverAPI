<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Product;

class Category extends Model
{
    use HasUuids;

    protected $table = 'categories';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'description'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
