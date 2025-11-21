<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'total_sold_count',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'total_sold_count' => 'integer'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function isBestSeller(): bool
    {
        return $this->total_sold_count >= 50;
    }
    
    public function isNew(): bool
    {
        return $this->created_at->diffInHours(now()) <= 24;
    }

    /**
     * Get average rating for this product
     */
    public function averageRating(): float
    {
        return round($this->reviews()->approved()->avg('rating') ?? 0, 1);
    }

    /**
     * Get total approved reviews count
     */
    public function reviewsCount(): int
    {
        return $this->reviews()->approved()->count();
    }

    /**
     * Get rating distribution (1-5 stars)
     */
    public function ratingDistribution(): array
    {
        $distribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $distribution[$i] = $this->reviews()->approved()->where('rating', $i)->count();
        }
        return $distribution;
    }
}

