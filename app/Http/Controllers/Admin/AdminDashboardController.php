<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\FlashSale;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'active_flash_sales' => FlashSale::active()->count(),
            'total_orders' => Order::count(),
            
            // Order status breakdown
            'pending_payment' => Order::where('status', 'pending_payment')->count(),
            'payment_uploaded' => Order::where('status', 'payment_uploaded')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            
            // Rating & Review statistics
            'total_reviews' => Review::count(),
            'average_rating' => round(Review::avg('rating'), 1) ?? 0,
            'pending_reviews' => Review::count(), // All reviews shown as pending
        ];
        
        // Top rated products
        $topRatedProducts = Product::with(['reviews', 'variants'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->having('reviews_count', '>', 0)
            ->orderBy('reviews_avg_rating', 'desc')
            ->take(5)
            ->get();
        
        // Recent reviews
        $recentReviews = Review::with(['user', 'product', 'orderItem'])
            ->latest()
            ->take(10)
            ->get();
        
        return view('admin.dashboard', compact('stats', 'topRatedProducts', 'recentReviews'));
    }
}
