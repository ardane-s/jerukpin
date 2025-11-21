<?php

namespace App\Http\Controllers;

use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
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
        
        return view('customer.flash-sales.index', compact('activeSession', 'upcomingSessions'));
    }
    
    public function show($id)
    {
        $flashSale = FlashSale::with(['productVariant.product.images', 'productVariant.product.category'])
            ->findOrFail($id);
        
        // Get related products from same category
        $relatedProducts = Product::with(['variants', 'images'])
            ->where('category_id', $flashSale->productVariant->product->category_id)
            ->where('id', '!=', $flashSale->productVariant->product_id)
            ->active()
            ->take(4)
            ->get();
        
        return view('customer.flash-sales.show', compact('flashSale', 'relatedProducts'));
    }
}
