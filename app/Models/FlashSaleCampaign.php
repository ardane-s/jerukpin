<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FlashSaleCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_time',
        'end_time',
        'is_active',
        'status',
        'show_teaser',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean',
        'show_teaser' => 'boolean',
    ];

    /**
     * Relationship: Campaign has many flash sale items
     */
    public function flashSales()
    {
        return $this->hasMany(FlashSale::class, 'campaign_id');
    }

    /**
     * Scope: Get active campaigns
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('is_active', true);
    }

    /**
     * Scope: Get upcoming campaigns
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'scheduled')
                    ->where('start_time', '>', now())
                    ->orderBy('start_time', 'asc');
    }

    /**
     * Scope: Get ended campaigns
     */
    public function scopeEnded($query)
    {
        return $query->where('status', 'ended')
                    ->orderBy('end_time', 'desc');
    }

    /**
     * Check if campaign is currently active
     */
    public function isActive(): bool
    {
        return $this->status === 'active' 
            && $this->is_active 
            && now()->between($this->start_time, $this->end_time);
    }

    /**
     * Check if campaign is upcoming
     */
    public function isUpcoming(): bool
    {
        return $this->status === 'scheduled' 
            && now()->lt($this->start_time);
    }

    /**
     * Check if campaign has ended
     */
    public function isEnded(): bool
    {
        return $this->status === 'ended' 
            || now()->gt($this->end_time);
    }

    /**
     * Get time remaining until campaign starts (for upcoming)
     */
    public function getTimeUntilStart(): ?Carbon
    {
        if ($this->isUpcoming()) {
            return now()->diffAsCarbonInterval($this->start_time);
        }
        return null;
    }

    /**
     * Get time remaining until campaign ends (for active)
     */
    public function getTimeRemaining(): ?Carbon
    {
        if ($this->isActive()) {
            return now()->diffAsCarbonInterval($this->end_time);
        }
        return null;
    }

    /**
     * Get total products in campaign
     */
    public function getTotalProductsAttribute(): int
    {
        return $this->flashSales()->count();
    }

    /**
     * Get total items sold in campaign
     */
    public function getTotalSoldAttribute(): int
    {
        return $this->flashSales()->sum('flash_sold');
    }

    /**
     * Get total revenue from campaign
     */
    public function getTotalRevenueAttribute(): float
    {
        return $this->flashSales()
            ->get()
            ->sum(function ($sale) {
                return $sale->flash_price * $sale->flash_sold;
            });
    }
}
