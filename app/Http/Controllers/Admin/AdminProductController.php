<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'variants', 'images'])
            ->withCount('variants')
            ->latest()
            ->paginate(15);
        
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            
            // Initial variant
            'variant_name' => 'required|string|max:100',
            'sku' => 'required|string|unique:product_variants,sku|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        
        // Create product
        $product = Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);
        
        // Create initial variant
        ProductVariant::create([
            'product_id' => $product->id,
            'variant_name' => $validated['variant_name'],
            'sku' => $validated['sku'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'sort_order' => 1,
            'is_active' => true,
        ]);
        
        return redirect()->route('admin.products.edit', $product)
            ->with('success', 'Produk berhasil ditambahkan. Silakan upload gambar.');
    }

    public function edit(Product $product)
    {
        $product->load(['variants', 'images', 'category']);
        $categories = Category::active()->get();
        
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        
        $validated['is_active'] = $request->has('is_active');
        
        $product->update($validated);
        
        return redirect()->route('admin.products.edit', $product)
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Check if product has orders
        $hasOrders = $product->variants()
            ->whereHas('orderItems')
            ->exists();
        
        if ($hasOrders) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Produk tidak dapat dihapus karena sudah ada pesanan.');
        }
        
        // Delete images from storage
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
    
    // Image Management
    public function uploadImages(Request $request, Product $product)
    {
        $request->validate([
            'images' => 'required|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120', // 5MB
        ]);
        
        // Check current image count
        $currentCount = $product->images()->count();
        $newCount = count($request->file('images'));
        
        if ($currentCount + $newCount > 5) {
            return back()->with('error', 'Maksimal 5 gambar per produk.');
        }
        
        $uploadedCount = 0;
        foreach ($request->file('images') as $image) {
            $path = $image->store('products/' . $product->id, 'public');
            
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'is_primary' => $currentCount == 0 && $uploadedCount == 0, // First image is primary
                'sort_order' => $currentCount + $uploadedCount + 1,
            ]);
            
            $uploadedCount++;
        }
        
        return back()->with('success', "{$uploadedCount} gambar berhasil diupload.");
    }
    
    public function deleteImage(ProductImage $image)
    {
        // Delete from storage
        Storage::disk('public')->delete($image->image_path);
        
        // If this was primary, set another image as primary
        if ($image->is_primary) {
            $nextImage = ProductImage::where('product_id', $image->product_id)
                ->where('id', '!=', $image->id)
                ->orderBy('sort_order')
                ->first();
            
            if ($nextImage) {
                $nextImage->update(['is_primary' => true]);
            }
        }
        
        $image->delete();
        
        return back()->with('success', 'Gambar berhasil dihapus.');
    }
    
    public function setPrimaryImage(ProductImage $image)
    {
        // Remove primary from all images of this product
        ProductImage::where('product_id', $image->product_id)
            ->update(['is_primary' => false]);
        
        // Set this image as primary
        $image->update(['is_primary' => true]);
        
        return back()->with('success', 'Gambar utama berhasil diatur.');
    }
    
    // Variant Management
    public function addVariant(Request $request, Product $product)
    {
        $validated = $request->validate([
            'variant_name' => 'required|string|max:100',
            'sku' => 'required|string|unique:product_variants,sku|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        
        $maxSortOrder = $product->variants()->max('sort_order') ?? 0;
        
        ProductVariant::create([
            'product_id' => $product->id,
            'variant_name' => $validated['variant_name'],
            'sku' => $validated['sku'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'sort_order' => $maxSortOrder + 1,
            'is_active' => true,
        ]);
        
        return back()->with('success', 'Varian berhasil ditambahkan.');
    }
    
    public function updateVariant(Request $request, ProductVariant $variant)
    {
        $validated = $request->validate([
            'variant_name' => 'required|string|max:100',
            'sku' => 'required|string|max:100|unique:product_variants,sku,' . $variant->id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);
        
        $validated['is_active'] = $request->has('is_active');
        
        $variant->update($validated);
        
        return back()->with('success', 'Varian berhasil diperbarui.');
    }
    
    public function deleteVariant(ProductVariant $variant)
    {
        // Check if variant has orders
        if ($variant->orderItems()->exists()) {
            return back()->with('error', 'Varian tidak dapat dihapus karena sudah ada pesanan.');
        }
        
        // Check if this is the last variant
        if ($variant->product->variants()->count() <= 1) {
            return back()->with('error', 'Produk harus memiliki minimal 1 varian.');
        }
        
        $variant->delete();
        
        return back()->with('success', 'Varian berhasil dihapus.');
    }
}
