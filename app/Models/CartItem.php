<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_variant_id',
        'quantity',
        'price_snapshot',
    ];
    
    protected $casts = [
        'quantity' => 'integer',
        'price_snapshot' => 'decimal:2',
    ];
    
    // Relationships
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
    
    // Accessors
    public function getPriceAttribute()
    {
        return $this->price_snapshot;
    }
    
    public function getSubtotalAttribute()
    {
        return $this->price_snapshot * $this->quantity;
    }
}
