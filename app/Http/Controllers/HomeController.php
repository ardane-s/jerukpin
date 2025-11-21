<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\FlashSale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get all flash sales grouped by session (start_time)
        $allFlashSales = FlashSale::with(['productVariant.product.images'])
            ->where('end_time', '>', now())
            ->orderBy('start_time', 'asc')
            ->get()
            ->groupBy(function($sale) {
                return $sale->start_time->format('Y-m-d H:i');
            });
        
        // Separate active and upcoming sessions
        $activeSession = null;
        $upcomingSessions = collect();
        
        foreach ($allFlashSales as $sessionTime => $sales) {
            $firstSale = $sales->first();
            if ($firstSale->start_time <= now() && $firstSale->end_time > now()) {
                // This is the active session
                $activeSession = [
                    'start_time' => $firstSale->start_time,
                    'end_time' => $firstSale->end_time,
                    'sales' => $sales
                ];
            } elseif ($firstSale->start_time > now()) {
                // This is an upcoming session
                $upcomingSessions->push([
                    'start_time' => $firstSale->start_time,
                    'end_time' => $firstSale->end_time,
                    'sales' => $sales
                ]);
            }
        }
        
        // Best sellers (50+ sold)
        $bestSellers = Product::with(['variants', 'images'])
            ->active()
            ->where('total_sold_count', '>=', 50)
            ->orderBy('total_sold_count', 'desc')
            ->take(8)
            ->get();
        
        // New arrivals
        $newArrivals = Product::with(['variants', 'images'])
            ->active()
            ->latest()
            ->take(8)
            ->get();
        
        // Featured categories with products
        $categories = Category::active()
            ->withCount('products')
            ->take(6)
            ->get();
            
        $categoriesWithProducts = Category::active()
            ->with(['products' => function($query) {
                $query->active()->with(['variants', 'images'])->take(10);
            }])
            ->withCount('products')
            ->take(6)
            ->get();
        
        return view('customer.home', compact(
            'activeSession',
            'upcomingSessions',
            'bestSellers',
            'newArrivals',
            'categories',
            'categoriesWithProducts'
        ));
    }
}
