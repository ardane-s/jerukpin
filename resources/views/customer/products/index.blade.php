@extends('layouts.app')

@section('title', 'Produk - JerukPin')

@section('content')
<!-- Breadcrumbs -->
<div class="bg-gradient-to-r from-orange-50 to-yellow-50 border-b border-orange-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-neutral-600 hover:text-orange-600 transition">🏠 Beranda</a>
            <span class="text-neutral-400">›</span>
            <span class="text-orange-600 font-medium">Produk</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-heading font-bold text-neutral-900 mb-2">
                <span class="bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">Semua Produk</span>
            </h1>
            <p class="text-neutral-600">
                Menampilkan <span class="font-bold text-orange-600">{{ $products->total() }}</span> produk
            </p>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Enhanced Filter Sidebar -->
        <div class="w-full lg:w-72 flex-shrink-0">
            <div class="bg-white rounded-2xl shadow-lg border-2 border-orange-100 overflow-hidden sticky top-24">
                <!-- Filter Header -->
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                    <h3 class="font-bold text-white text-lg flex items-center gap-2">
                        🔍 Filter Produk
                    </h3>
                </div>
                
                <form action="{{ route('products.index') }}" method="GET" class="p-6 space-y-6">
                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-bold text-neutral-800 mb-3 flex items-center gap-2">
                            🏷️ Kategori
                        </label>
                        <select name="category" class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition" onchange="this.form.submit()">
                            <option value="">📦 Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    🍊 {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort Filter -->
                    <div>
                        <label class="block text-sm font-bold text-neutral-800 mb-3 flex items-center gap-2">
                            ⚡ Urutkan
                        </label>
                        <select name="sort" class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>🆕 Terbaru</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>🔥 Terpopuler</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>💰 Harga Terendah</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>💎 Harga Tertinggi</option>
                        </select>
                    </div>

                    <!-- Clear Filters -->
                    @if(request('category') || request('sort'))
                        <div class="pt-4 border-t border-neutral-200">
                            <a href="{{ route('products.index') }}" class="block w-full text-center px-4 py-3 bg-neutral-100 hover:bg-neutral-200 text-neutral-700 rounded-xl font-medium transition">
                                🔄 Reset Filter
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                            <div class="text-6xl mb-4">🔍</div>
                            <h3 class="text-2xl font-bold text-neutral-900 mb-2">Produk Tidak Ditemukan</h3>
                            <p class="text-neutral-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                            <a href="{{ route('products.index') }}" class="inline-block bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-8 py-3 rounded-xl font-bold transition shadow-lg">
                                Lihat Semua Produk
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
