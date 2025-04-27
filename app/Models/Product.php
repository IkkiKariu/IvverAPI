<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Specification;
use App\Models\Category;
use App\Models\MeasurementUnit;

class Product extends Model
{
    use HasUuids;

    protected $table = 'products';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
        'price',
        'measurement_unit_id',
        'category_id'
    ];

    public function specifications(): HasMany
    {
        return $this->hasMany(Specification::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function measurement_unit(): BelongsTo
    {
        return $this->belongsTo(MeasurementUnit::class);
    }     
}
