<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    protected $fillable = [
        'product_variant_id',
        'original_price',
        'flash_price',
        'flash_stock',
        'flash_sold',
        'start_time',
        'end_time',
        'is_active',
    ];
    
    protected $casts = [
        'original_price' => 'decimal:2',
        'flash_price' => 'decimal:2',
        'flash_stock' => 'integer',
        'flash_sold' => 'integer',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean',
    ];
    
    // Relationships
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
    
    // Helper methods
    public function isActive(): bool
    {
        return $this->is_active 
            && $this->start_time <= now() 
            && $this->end_time > now()
            && $this->flash_sold < $this->flash_stock;
    }
    
    public function getDiscountPercentageAttribute()
    {
        if ($this->original_price == 0) return 0;
        return round((($this->original_price - $this->flash_price) / $this->original_price) * 100);
    }
    
    public function getRemainingStockAttribute()
    {
        return max(0, $this->flash_stock - $this->flash_sold);
    }
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('start_time', '<=', now())
            ->where('end_time', '>', now())
            ->whereRaw('flash_sold < flash_stock');
    }
}
