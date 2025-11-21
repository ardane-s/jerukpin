<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class AdminFlashSaleController extends Controller
{
    public function index()
    {
        $activeFlashSales = FlashSale::with(['productVariant.product'])
            ->where('end_time', '>=', now())
            ->latest()
            ->paginate(15, ['*'], 'active_page');
        
        $endedFlashSales = FlashSale::with(['productVariant.product'])
            ->where('end_time', '<', now())
            ->latest()
            ->paginate(15, ['*'], 'ended_page');
        
        return view('admin.flash-sales.index', compact('activeFlashSales', 'endedFlashSales'));
    }

    public function create()
    {
        // Get variants that don't have active flash sales
        $availableVariants = ProductVariant::with('product')
            ->whereDoesntHave('flashSale')
            ->active()
            ->get();
        
        return view('admin.flash-sales.create', compact('availableVariants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id|unique:flash_sales,product_variant_id',
            'flash_price' => 'required|numeric|min:0',
            'flash_stock' => 'required|integer|min:1',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);
        
        // Get variant to validate
        $variant = ProductVariant::findOrFail($validated['product_variant_id']);
        
        // Validate flash price < original price
        if ($validated['flash_price'] >= $variant->price) {
            return back()->withInput()
                ->with('error', 'Harga flash sale harus lebih rendah dari harga normal.');
        }
        
        // Validate flash stock <= variant stock
        if ($validated['flash_stock'] > $variant->stock) {
            return back()->withInput()
                ->with('error', 'Stok flash sale tidak boleh melebihi stok varian.');
        }
        
        FlashSale::create([
            'product_variant_id' => $validated['product_variant_id'],
            'original_price' => $variant->price,
            'flash_price' => $validated['flash_price'],
            'flash_stock' => $validated['flash_stock'],
            'flash_sold' => 0,
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'is_active' => true,
        ]);
        
        return redirect()->route('admin.flash-sales.index')
            ->with('success', 'Flash sale berhasil dibuat.');
    }

    public function edit(FlashSale $flashSale)
    {
        $flashSale->load('productVariant.product');
        return view('admin.flash-sales.edit', compact('flashSale'));
    }

    public function update(Request $request, FlashSale $flashSale)
    {
        $validated = $request->validate([
            'flash_price' => 'required|numeric|min:0',
            'flash_stock' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'is_active' => 'boolean',
        ]);
        
        // Validate flash price < original price
        if ($validated['flash_price'] >= $flashSale->original_price) {
            return back()->withInput()
                ->with('error', 'Harga flash sale harus lebih rendah dari harga normal.');
        }
        
        // Validate flash stock
        $variant = $flashSale->productVariant;
        if ($validated['flash_stock'] > $variant->stock) {
            return back()->withInput()
                ->with('error', 'Stok flash sale tidak boleh melebihi stok varian.');
        }
        
        $validated['is_active'] = $request->has('is_active');
        
        $flashSale->update($validated);
        
        return redirect()->route('admin.flash-sales.index')
            ->with('success', 'Flash sale berhasil diperbarui.');
    }

    public function destroy(FlashSale $flashSale)
    {
        $flashSale->delete();
        
        return redirect()->route('admin.flash-sales.index')
            ->with('success', 'Flash sale berhasil dihapus.');
    }
    
    public function deactivate(FlashSale $flashSale)
    {
        $flashSale->update(['is_active' => false]);
        
        return back()->with('success', 'Flash sale berhasil dinonaktifkan.');
    }
}
