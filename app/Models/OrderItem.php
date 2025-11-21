<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_variant_id',
        'product_name',
        'variant_name',
        'price',
        'quantity',
        'is_flash_sale',
    ];
    
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'is_flash_sale' => 'boolean',
    ];
    
    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
    
    public function review()
    {
        return $this->hasOne(Review::class);
    }
    
    // Accessors
    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }
    
    // Helper methods
    public function canBeReviewed(): bool
    {
        return $this->order->status === 'delivered' && !$this->review()->exists();
    }
}
