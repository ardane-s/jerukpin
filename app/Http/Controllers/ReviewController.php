<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_item_id' => 'required|exists:order_items,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Verify that the user owns this order item
        $orderItem = OrderItem::with('order')->findOrFail($request->order_item_id);
        
        if ($orderItem->order->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk mereview produk ini.');
        }

        // Check if order is completed
        if ($orderItem->order->status !== 'delivered') {
            return back()->with('error', 'Anda hanya dapat mereview produk setelah pesanan selesai.');
        }

        // Check if already reviewed
        $existingReview = Review::where('order_item_id', $request->order_item_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah mereview produk ini.');
        }

        // Create review
        Review::create([
            'order_item_id' => $request->order_item_id,
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false, // Needs admin approval
        ]);

        return back()->with('success', 'Review Anda telah dikirim dan menunggu persetujuan admin.');
    }

    /**
     * Show reviews for a product
     */
    public function index(Product $product)
    {
        $reviews = $product->reviews()
            ->approved()
            ->with(['user'])
            ->latest()
            ->paginate(10);

        $averageRating = $product->reviews()->approved()->avg('rating');
        $totalReviews = $product->reviews()->approved()->count();

        return view('customer.reviews.index', compact('product', 'reviews', 'averageRating', 'totalReviews'));
    }
}
