<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReviewController extends Controller
{
    /**
     * Display a listing of reviews
     */
    public function index(Request $request)
    {
        $query = Review::with(['product', 'user', 'orderItem']);

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'approved') {
                $query->approved();
            } elseif ($request->status === 'pending') {
                $query->pending();
            }
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $reviews = $query->latest()->paginate(20);
        $pendingCount = Review::pending()->count();

        return view('admin.reviews.index', compact('reviews', 'pendingCount'));
    }

    /**
     * Approve a review
     */
    public function approve(Review $review)
    {
        $review->update([
            'is_approved' => true,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Review berhasil disetujui.');
    }

    /**
     * Reject/Delete a review
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('success', 'Review berhasil dihapus.');
    }

    /**
     * Show review details
     */
    public function show(Review $review)
    {
        $review->load(['product', 'user', 'orderItem.order']);

        return view('admin.reviews.show', compact('review'));
    }
}
