<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
    ];
    
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    
    // Alias for cartItems (for compatibility)
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
    
    // Helper methods
    public function getTotalAttribute()
    {
        return $this->cartItems->sum(function($item) {
            return $item->price_snapshot * $item->quantity;
        });
    }
    
    public function getItemCountAttribute()
    {
        return $this->cartItems->sum('quantity');
    }
}
