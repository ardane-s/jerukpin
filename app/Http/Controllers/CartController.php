<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = $this->getCartItems();
        $total = $this->calculateTotal($cartItems);
        
        return view('customer.cart.index', compact('cartItems', 'total'));
    }
    
    public function add(Request $request)
    {
        $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $variant = ProductVariant::findOrFail($request->product_variant_id);
        
        // Check stock
        if ($variant->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }
        
        if (auth()->check()) {
            // Logged-in user: save to database
            $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
            
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_variant_id', $variant->id)
                ->first();
            
            if ($cartItem) {
                $newQuantity = $cartItem->quantity + $request->quantity;
                if ($newQuantity > $variant->stock) {
                    return back()->with('error', 'Stok tidak mencukupi.');
                }
                $cartItem->update(['quantity' => $newQuantity]);
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_variant_id' => $variant->id,
                    'quantity' => $request->quantity,
                    'price_snapshot' => $variant->getEffectivePriceAttribute(),
                ]);
            }
        } else {
            // Guest: save to session
            $cart = session()->get('cart', []);
            
            if (isset($cart[$variant->id])) {
                $newQuantity = $cart[$variant->id]['quantity'] + $request->quantity;
                if ($newQuantity > $variant->stock) {
                    return back()->with('error', 'Stok tidak mencukupi.');
                }
                $cart[$variant->id]['quantity'] = $newQuantity;
            } else {
                $cart[$variant->id] = [
                    'variant_id' => $variant->id,
                    'quantity' => $request->quantity,
                    'price' => $variant->getEffectivePriceAttribute(),
                ];
            }
            
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
    
    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        if (auth()->check()) {
            $cartItem = CartItem::where('cart_id', auth()->user()->cart->id)
                ->where('id', $itemId)
                ->firstOrFail();
            
            if ($cartItem->productVariant->stock < $request->quantity) {
                return back()->with('error', 'Stok tidak mencukupi.');
            }
            
            $cartItem->update(['quantity' => $request->quantity]);
        } else {
            $cart = session()->get('cart', []);
            
            if (isset($cart[$itemId])) {
                $variant = ProductVariant::find($itemId);
                if ($variant->stock < $request->quantity) {
                    return back()->with('error', 'Stok tidak mencukupi.');
                }
                $cart[$itemId]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
            }
        }
        
        return back()->with('success', 'Keranjang diperbarui.');
    }
    
    public function remove($itemId)
    {
        if (auth()->check()) {
            CartItem::where('cart_id', auth()->user()->cart->id)
                ->where('id', $itemId)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$itemId]);
            session()->put('cart', $cart);
        }
        
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
    
    public function clear()
    {
        if (auth()->check()) {
            auth()->user()->cart->items()->delete();
        } else {
            session()->forget('cart');
        }
        
        return back()->with('success', 'Keranjang dikosongkan.');
    }
    
    private function getCartItems()
    {
        if (auth()->check()) {
            $cart = Cart::with(['items.productVariant.product.images'])
                ->where('user_id', auth()->id())
                ->first();
            
            return $cart ? $cart->items : collect();
        } else {
            $sessionCart = session()->get('cart', []);
            $items = collect();
            
            foreach ($sessionCart as $variantId => $item) {
                $variant = ProductVariant::with('product.images')->find($variantId);
                if ($variant) {
                    $items->push((object)[
                        'id' => $variantId,
                        'productVariant' => $variant,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }
            }
            
            return $items;
        }
    }
    
    private function calculateTotal($cartItems)
    {
        return $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }
}
