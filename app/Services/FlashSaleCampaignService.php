<?php

namespace App\Services;

use App\Models\FlashSaleCampaign;
use Carbon\Carbon;

class FlashSaleCampaignService
{
    /**
     * Update campaign statuses based on current time
     * This should be called by a scheduled task every minute
     */
    public static function updateCampaignStatuses(): void
    {
        // Activate campaigns that should start
        FlashSaleCampaign::where('status', 'scheduled')
            ->where('start_time', '<=', now())
            ->where('end_time', '>', now())
            ->update([
                'status' => 'active',
                'is_active' => true,
            ]);

        // End campaigns that should finish
        FlashSaleCampaign::where('status', 'active')
            ->where('end_time', '<=', now())
            ->update([
                'status' => 'ended',
                'is_active' => false,
            ]);
    }

    /**
     * Get the currently active campaign
     */
    public static function getActiveCampaign(): ?FlashSaleCampaign
    {
        return FlashSaleCampaign::active()
            ->with(['flashSales.productVariant.product.images'])
            ->first();
    }

    /**
     * Get the next upcoming campaign
     */
    public static function getUpcomingCampaign(): ?FlashSaleCampaign
    {
        return FlashSaleCampaign::upcoming()
            ->where('show_teaser', true)
            ->first();
    }

    /**
     * Get all upcoming campaigns in queue
     */
    public static function getUpcomingQueue()
    {
        return FlashSaleCampaign::upcoming()->get();
    }

    /**
     * Check if a campaign can be edited
     */
    public static function canEdit(FlashSaleCampaign $campaign): bool
    {
        // Can only edit if not yet started or if it's scheduled
        return $campaign->status === 'scheduled' && now()->lt($campaign->start_time);
    }

    /**
     * Check if a campaign can be deleted
     */
    public static function canDelete(FlashSaleCampaign $campaign): bool
    {
        // Can delete if not active
        return $campaign->status !== 'active';
    }
}
