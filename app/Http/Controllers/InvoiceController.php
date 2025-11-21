<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show($orderNumber)
    {
        // Find order by order number
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        
        // Check authorization - order must belong to current user (if logged in) or be accessible by guest
        if (auth()->check()) {
            // For logged-in users, check if order belongs to them
            if ($order->user_id !== auth()->id()) {
                abort(403, 'Unauthorized access to this order.');
            }
        } else {
            // For guests, they can only access if they have the order number
            // Additional security: you might want to add a token or session check here
            if ($order->user_id !== null) {
                abort(403, 'This order requires authentication.');
            }
        }
        
        // Only allow invoice for completed orders
        if (!in_array($order->status, ['delivered', 'payment_verified', 'processing', 'shipped'])) {
            return redirect()->route('orders.show', $order->order_number)
                ->with('error', 'Invoice hanya tersedia untuk pesanan yang sudah diproses.');
        }
        
        return view('customer.orders.invoice', compact('order'));
    }
}
