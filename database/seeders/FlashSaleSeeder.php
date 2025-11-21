<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FlashSale;
use App\Models\ProductVariant;
use Carbon\Carbon;

class FlashSaleSeeder extends Seeder
{
    public function run()
    {
        // Clear existing flash sales
        FlashSale::truncate();
        
        // Get all product variants
        $variants = ProductVariant::with('product')->get();
        
        if ($variants->count() < 25) {
            $this->command->error('Not enough variants. Found: ' . $variants->count());
            return;
        }
        
        $created = 0;
        $now = Carbon::now();
        
        // Session 1: Active now (10 products) - ends in 3 hours
        $session1Start = $now->copy()->subHours(1);
        $session1End = $now->copy()->addHours(3);
        
        for ($i = 0; $i < 10 && $i < $variants->count(); $i++) {
            $variant = $variants[$i];
            $discountPercent = rand(20, 50);
            $flashPrice = $variant->price * (100 - $discountPercent) / 100;
            
            FlashSale::create([
                'product_variant_id' => $variant->id,
                'original_price' => $variant->price,
                'flash_price' => round($flashPrice),
                'discount_percentage' => $discountPercent,
                'flash_stock' => min($variant->stock, rand(10, 30)),
                'flash_sold' => rand(0, 5),
                'start_time' => $session1Start,
                'end_time' => $session1End,
                'is_active' => true,
            ]);
            $created++;
        }
        
        // Session 2: Upcoming in 4 hours (10 products)
        $session2Start = $now->copy()->addHours(4);
        $session2End = $session2Start->copy()->addHours(4);
        
        for ($i = 10; $i < 20 && $i < $variants->count(); $i++) {
            $variant = $variants[$i];
            $discountPercent = rand(25, 60);
            $flashPrice = $variant->price * (100 - $discountPercent) / 100;
            
            FlashSale::create([
                'product_variant_id' => $variant->id,
                'original_price' => $variant->price,
                'flash_price' => round($flashPrice),
                'discount_percentage' => $discountPercent,
                'flash_stock' => min($variant->stock, rand(15, 40)),
                'flash_sold' => 0,
                'start_time' => $session2Start,
                'end_time' => $session2End,
                'is_active' => true,
            ]);
            $created++;
        }
        
        // Session 3: Upcoming tomorrow (5 products)
        $session3Start = $now->copy()->addDay()->setHour(10)->setMinute(0);
        $session3End = $session3Start->copy()->addHours(6);
        
        for ($i = 20; $i < 25 && $i < $variants->count(); $i++) {
            $variant = $variants[$i];
            $discountPercent = rand(30, 70);
            $flashPrice = $variant->price * (100 - $discountPercent) / 100;
            
            FlashSale::create([
                'product_variant_id' => $variant->id,
                'original_price' => $variant->price,
                'flash_price' => round($flashPrice),
                'discount_percentage' => $discountPercent,
                'flash_stock' => min($variant->stock, rand(20, 50)),
                'flash_sold' => 0,
                'start_time' => $session3Start,
                'end_time' => $session3End,
                'is_active' => true,
            ]);
            $created++;
        }
        
        $this->command->info("Created {$created} flash sales across 3 sessions");
        $this->command->info("Session 1 (Active): {$session1Start->format('Y-m-d H:i')} - {$session1End->format('Y-m-d H:i')}");
        $this->command->info("Session 2 (Upcoming): {$session2Start->format('Y-m-d H:i')} - {$session2End->format('Y-m-d H:i')}");
        $this->command->info("Session 3 (Tomorrow): {$session3Start->format('Y-m-d H:i')} - {$session3End->format('Y-m-d H:i')}");
    }
}
