<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Ingredient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'unit',
        'cost_per_unit',
        'stock',
        'active'
    ];

    protected $casts = [
        'cost_per_unit' => 'decimal:2',
        'active' => 'boolean',
    ];

    /**
     * Get the products that use this ingredient.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'unit')
            ->withTimestamps();
    }

    /**
     * Scope a query to only include active ingredients.
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
