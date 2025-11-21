<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'variant_name',
        'sku',
        'price',
        'stock',
        'sold_count',
        'sort_order',
        'is_active',
    ];
    
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'sold_count' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];
    
    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function flashSale()
    {
        return $this->hasOne(FlashSale::class);
    }
    
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    // Helper methods
    public function hasActiveFlashSale(): bool
    {
        return $this->flashSale()
            ->where('is_active', true)
            ->where('start_time', '<=', now())
            ->where('end_time', '>', now())
            ->whereRaw('flash_sold < flash_stock')
            ->exists();
    }
    
    public function activeFlashSale()
    {
        return $this->flashSale()
            ->where('is_active', true)
            ->where('start_time', '<=', now())
            ->where('end_time', '>', now())
            ->whereRaw('flash_sold < flash_stock')
            ->first();
    }
    
    public function getEffectivePriceAttribute()
    {
        if ($this->hasActiveFlashSale()) {
            return $this->flashSale->flash_price;
        }
        return $this->price;
    }
    
    public function isInStock(): bool
    {
        return $this->stock > 0;
    }
    
    public function incrementSoldCount(int $quantity): void
    {
        $this->increment('sold_count', $quantity);
        
        // Update product total sold count
        $this->product->update([
            'total_sold_count' => $this->product->variants()->sum('sold_count')
        ]);
    }
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }
}
