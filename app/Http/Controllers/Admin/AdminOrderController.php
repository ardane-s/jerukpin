<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems', 'payment.paymentProof'])
            ->latest();
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $orders = $query->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.productVariant.product', 'payment.paymentProof', 'address']);
        
        return view('admin.orders.show', compact('order'));
    }
    
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending_payment,payment_uploaded,processing,shipped,delivered,cancelled',
        ]);
        
        $order->update(['status' => $request->status]);
        
        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
    
    public function verifyPayment(Order $order)
    {
        if (!$order->payment || !$order->payment->paymentProof) {
            return back()->with('error', 'Bukti pembayaran belum diupload.');
        }
        
        // Update payment status
        $order->payment->update([
            'status' => 'verified',
            'verified_at' => now(),
        ]);
        
        // Update payment proof
        $order->payment->paymentProof->update([
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);
        
        // Update order status
        $order->update(['status' => 'processing']);
        
        // Update sold counts
        foreach ($order->orderItems as $item) {
            $item->productVariant->incrementSoldCount($item->quantity);
            $item->productVariant->product->increment('total_sold_count', $item->quantity);
        }
        
        return back()->with('success', 'Pembayaran berhasil diverifikasi. Stok terjual telah diperbarui.');
    }
    
    public function rejectPayment(Request $request, Order $order)
    {
        $request->validate([
            'rejection_reason' => 'required|string',
        ]);
        
        if (!$order->payment || !$order->payment->paymentProof) {
            return back()->with('error', 'Bukti pembayaran belum diupload.');
        }
        
        // Update payment status
        $order->payment->update(['status' => 'rejected']);
        
        // Update payment proof
        $order->payment->paymentProof->update([
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);
        
        // Update order status back to pending
        $order->update(['status' => 'pending_payment']);
        
        return back()->with('success', 'Pembayaran ditolak. Pelanggan harus upload ulang bukti pembayaran.');
    }
}
