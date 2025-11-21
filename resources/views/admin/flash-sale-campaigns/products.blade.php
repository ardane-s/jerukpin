@extends('admin.layouts.app')

@section('title', 'Kelola Produk Campaign')
@section('page-title', $campaign->name)
@section('page-description', 'Tambah dan kelola produk dalam campaign ini')

@section('content')
<!-- Campaign Info -->
<div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">
    <div class="flex items-start justify-between">
        <div>
            <h2 class="text-xl font-bold text-blue-900 mb-2">{{ $campaign->name }}</h2>
            <div class="flex items-center gap-4 text-sm text-blue-700">
                <span>📅 {{ $campaign->start_time->format('d M Y, H:i') }} - {{ $campaign->end_time->format('d M Y, H:i') }}</span>
                <span>•</span>
                <span>{{ $campaign->flashSales->count() }} produk</span>
            </div>
        </div>
        <a href="{{ route('admin.flash-sale-campaigns.index') }}" class="text-blue-700 hover:text-blue-900 font-medium text-sm">
            ← Kembali
        </a>
    </div>
</div>

<!-- Add Product Section -->
<div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6 mb-6">
    <h3 class="text-lg font-bold text-neutral-900 mb-4">Tambah Produk ke Campaign</h3>
    
    <form action="{{ route('admin.flash-sale-campaigns.add-product', $campaign) }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @csrf
        
        <!-- Product Variant Selection -->
        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-neutral-700 mb-2">Pilih Produk & Varian</label>
            <select name="product_variant_id" required
                    class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition">
                <option value="">-- Pilih Produk --</option>
                @foreach($products as $product)
                    <optgroup label="{{ $product->name }}">
                        @foreach($product->variants as $variant)
                            <option value="{{ $variant->id }}" data-price="{{ $variant->price }}">
                                {{ $variant->variant_name }} - Rp {{ number_format($variant->price, 0, ',', '.') }} (Stok: {{ $variant->stock }})
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>

        <!-- Flash Price -->
        <div>
            <label class="block text-sm font-semibold text-neutral-700 mb-2">Harga Flash Sale</label>
            <input type="number" name="flash_price" required min="0" step="1"
                   class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition"
                   placeholder="0">
        </div>

        <!-- Flash Stock -->
        <div>
            <label class="block text-sm font-semibold text-neutral-700 mb-2">Stok Flash</label>
            <input type="number" name="flash_stock" required min="1" step="1"
                   class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition"
                   placeholder="0">
        </div>

        <!-- Submit Button -->
        <div class="md:col-span-4">
            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition">
                + Tambah ke Campaign
            </button>
        </div>
    </form>
</div>

<!-- Products in Campaign -->
<div class="bg-white rounded-xl shadow-sm border border-neutral-200">
    <div class="px-6 py-4 border-b border-neutral-200">
        <h3 class="text-lg font-bold text-neutral-900">Produk dalam Campaign ({{ $campaign->flashSales->count() }})</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-neutral-200">
            <thead class="bg-neutral-50">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Terjual</th>
                    <th class="px-6 py-3.5 text-right text-xs font-semibold text-neutral-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200">
                @forelse($campaign->flashSales as $sale)
                    <tr class="hover:bg-neutral-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($sale->productVariant->product->images->first())
                                    <img src="{{ asset('storage/' . $sale->productVariant->product->images->first()->image_path) }}" 
                                         alt="{{ $sale->productVariant->product->name }}" 
                                         class="w-12 h-12 rounded-lg object-cover border border-neutral-200">
                                @else
                                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-semibold text-neutral-900 text-sm">{{ $sale->productVariant->product->name }}</div>
                                    <div class="text-xs text-neutral-500 mt-0.5">{{ $sale->productVariant->variant_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm">
                                <span class="line-through text-neutral-400">Rp {{ number_format($sale->original_price, 0, ',', '.') }}</span>
                                <span class="text-orange-600 font-bold ml-2">Rp {{ number_format($sale->flash_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-md bg-green-100 text-green-800 text-xs font-semibold">
                                {{ $sale->discount_percentage }}% OFF
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-neutral-700">{{ $sale->flash_stock }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-green-600">{{ $sale->flash_sold }}</div>
                            @if($sale->flash_stock > 0)
                                <div class="w-24 bg-neutral-200 rounded-full h-1.5 mt-1">
                                    <div class="bg-green-600 h-1.5 rounded-full" style="width: {{ ($sale->flash_sold / $sale->flash_stock) * 100 }}%"></div>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($sale->flash_sold == 0)
                                <form action="{{ route('admin.flash-sale-campaigns.remove-product', [$campaign, $sale]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini dari campaign?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 font-medium text-sm">Hapus</button>
                                </form>
                            @else
                                <span class="text-xs text-neutral-400">Sudah terjual</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <p class="mt-2 text-sm text-neutral-500">Belum ada produk dalam campaign ini</p>
                            <p class="text-xs text-neutral-400 mt-1">Gunakan form di atas untuk menambah produk</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
