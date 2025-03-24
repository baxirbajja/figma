<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Ingredient;
use App\Models\Category;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_fr',
        'name_en',
        'name_it',
        'description',
        'price',
        'delivery_price',
        'is_active',
        'image_path',
        'sku',
        'stock',
        'category_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'delivery_price' => 'decimal:2',
        'is_active' => 'boolean',
        'stock' => 'integer',
    ];

    /**
     * Get the ingredients associated with the product.
     */
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }
    /**
     * Get the name in the specified language.
     */
    public function getNameAttribute($language = 'fr')
    {
        return $this->{"name_$language"} ?? $this->name_fr;
    }

    /**
     * Scope a query to only include active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
