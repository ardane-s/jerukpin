<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Services\FlashSaleCampaignService;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Flash Sale Campaign Auto-Activation
Schedule::call(function () {
    FlashSaleCampaignService::updateCampaignStatuses();
})->everyMinute()->name('update-campaign-statuses');
