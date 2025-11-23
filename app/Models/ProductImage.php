<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];
    
    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];
    
    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    // Accessor
    public function getFullPathAttribute()
    {
        return Storage::url($this->image_path);
    }
}
