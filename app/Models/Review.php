<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'order_item_id',
        'user_id',
        'product_id',
        'rating',
        'comment',
        'is_approved',
        'approved_by',
        'approved_at',
    ];
    
    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
        'approved_at' => 'datetime',
    ];
    
    // Relationships
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    
    // Helper methods
    public function isApproved(): bool
    {
        return $this->is_approved;
    }
    
    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
    
    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }
}
