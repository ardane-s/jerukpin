<?php

namespace App\View\Composers;

use App\Models\FlashSale;
use Illuminate\View\View;

class NavbarComposer
{
    public function compose(View $view)
    {
        $hasActiveFlashSales = FlashSale::where('start_time', '<=', now())
            ->where('end_time', '>', now())
            ->exists();
            
        $view->with('hasActiveFlashSales', $hasActiveFlashSales);
    }
}
