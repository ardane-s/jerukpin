<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedPurchaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login untuk menulis review.');
        }
        
        // Get product ID from route parameter
        $productId = $request->route('product');
        
        // Check if user has purchased this product and received it
        $hasPurchased = \App\Models\OrderItem::whereHas('order', function($query) {
                $query->where('user_id', auth()->id())
                      ->where('status', 'delivered');
            })
            ->whereHas('productVariant', function($query) use ($productId) {
                $query->where('product_id', $productId);
            })
            ->exists();
        
        if (!$hasPurchased) {
            return redirect()->back()
                ->with('error', 'Anda hanya dapat mereview produk yang sudah Anda beli dan terima.');
        }
        
        // Check if user has already reviewed this product
        $hasReviewed = auth()->user()->reviews()
            ->where('product_id', $productId)
            ->exists();
        
        if ($hasReviewed) {
            return redirect()->back()
                ->with('error', 'Anda sudah memberikan review untuk produk ini.');
        }
        
        return $next($request);
    }
}
