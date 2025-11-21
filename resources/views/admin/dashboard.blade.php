@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan performa toko JerukPin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-heading font-bold text-neutral-900">Dashboard Admin</h1>
    <p class="text-neutral-600">Selamat datang kembali! ≡ƒæï</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Products -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="text-4xl">≡ƒôª</div>
            <div class="text-right">
                <p class="text-sm opacity-90">Total Produk</p>
                <p class="text-3xl font-bold">{{ $stats['total_products'] }}</p>
            </div>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-sm opacity-90 hover:opacity-100">Lihat semua ΓåÆ</a>
    </div>

    <!-- Categories -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="text-4xl">≡ƒôü</div>
            <div class="text-right">
                <p class="text-sm opacity-90">Total Kategori</p>
                <p class="text-3xl font-bold">{{ $stats['total_categories'] }}</p>
            </div>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="text-sm opacity-90 hover:opacity-100">Lihat semua ΓåÆ</a>
    </div>

    <!-- Flash Sales -->
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="text-4xl">≡ƒöÑ</div>
            <div class="text-right">
                <p class="text-sm opacity-90">Flash Sale Aktif</p>
                <p class="text-3xl font-bold">{{ $stats['active_flash_sales'] }}</p>
            </div>
        </div>
        <a href="{{ route('admin.flash-sales.index') }}" class="text-sm opacity-90 hover:opacity-100">Lihat semua ΓåÆ</a>
    </div>

    <!-- Total Orders -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="text-4xl">≡ƒ¢Æ</div>
            <div class="text-right">
                <p class="text-sm opacity-90">Total Pesanan</p>
                <p class="text-3xl font-bold">{{ $stats['total_orders'] }}</p>
            </div>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="text-sm opacity-90 hover:opacity-100">Lihat semua ΓåÆ</a>
    </div>
</div>

<!-- Rating & Review Statistics -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Reviews -->
    <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="text-4xl">Γ¡É</div>
            <div class="text-right">
                <p class="text-sm opacity-90">Total Review</p>
                <p class="text-3xl font-bold">{{ $stats['total_reviews'] }}</p>
            </div>
        </div>
        <p class="text-sm opacity-90">Rating Rata-rata: {{ $stats['average_rating'] }}/5.0</p>
    </div>

    <!-- Pending Reviews -->
    <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="text-4xl">≡ƒÆ¼</div>
            <div class="text-right">
                <p class="text-sm opacity-90">Review Masuk</p>
                <p class="text-3xl font-bold">{{ $stats['pending_reviews'] }}</p>
            </div>
        </div>
        <p class="text-sm opacity-90">Perlu ditanggapi</p>
    </div>

    <!-- Average Rating Display -->
    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="text-4xl">≡ƒôè</div>
            <div class="text-right">
                <p class="text-sm opacity-90">Kepuasan Pelanggan</p>
                <p class="text-3xl font-bold">{{ number_format(($stats['average_rating'] / 5) * 100, 0) }}%</p>
            </div>
        </div>
        <div class="flex gap-1">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= floor($stats['average_rating']))
                    <span class="text-yellow-300">Γ¡É</span>
                @else
                    <span class="opacity-30">Γ¡É</span>
                @endif
            @endfor
        </div>
    </div>
</div>

<!-- Order Status Breakdown -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-8">
    <h2 class="text-xl font-bold text-neutral-900 mb-6">Status Pesanan</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <!-- Pending Payment -->
        <div class="text-center p-4 bg-yellow-50 rounded-lg border border-yellow-200">
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending_payment'] }}</p>
            <p class="text-xs text-yellow-700 mt-1">Menunggu Pembayaran</p>
        </div>

        <!-- Payment Uploaded -->
        <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-200">
            <p class="text-2xl font-bold text-blue-600">{{ $stats['payment_uploaded'] }}</p>
            <p class="text-xs text-blue-700 mt-1">Perlu Verifikasi</p>
        </div>

        <!-- Processing -->
        <div class="text-center p-4 bg-purple-50 rounded-lg border border-purple-200">
            <p class="text-2xl font-bold text-purple-600">{{ $stats['processing'] }}</p>
            <p class="text-xs text-purple-700 mt-1">Diproses</p>
        </div>

        <!-- Shipped -->
        <div class="text-center p-4 bg-indigo-50 rounded-lg border border-indigo-200">
            <p class="text-2xl font-bold text-indigo-600">{{ $stats['shipped'] }}</p>
            <p class="text-xs text-indigo-700 mt-1">Dikirim</p>
        </div>

        <!-- Delivered -->
        <div class="text-center p-4 bg-green-50 rounded-lg border border-green-200">
            <p class="text-2xl font-bold text-green-600">{{ $stats['delivered'] }}</p>
            <p class="text-xs text-green-700 mt-1">Selesai</p>
        </div>

        <!-- Cancelled -->
        <div class="text-center p-4 bg-red-50 rounded-lg border border-red-200">
            <p class="text-2xl font-bold text-red-600">{{ $stats['cancelled'] }}</p>
            <p class="text-xs text-red-700 mt-1">Dibatalkan</p>
        </div>
    </div>
</div>

<!-- Top Rated Products & Recent Reviews -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Top Rated Products -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-xl font-bold text-neutral-900 mb-6">Γ¡É Produk Rating Tertinggi</h2>
        <div class="space-y-4">
            @forelse($topRatedProducts as $product)
                <div class="flex items-center justify-between p-4 bg-neutral-50 rounded-lg">
                    <div class="flex-1">
                        <p class="font-bold text-neutral-900">{{ $product->name }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($product->reviews_avg_rating))
                                        <span class="text-yellow-400 text-sm">Γ¡É</span>
                                    @else
                                        <span class="text-neutral-300 text-sm">Γ¡É</span>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-sm text-neutral-600">{{ number_format($product->reviews_avg_rating, 1) }}</span>
                            <span class="text-xs text-neutral-500">({{ $product->reviews_count }} review)</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-primary-600 hover:text-primary-700 text-sm">
                        Lihat ΓåÆ
                    </a>
                </div>
            @empty
                <p class="text-neutral-500 text-center py-8">Belum ada review produk</p>
            @endforelse
        </div>
    </div>

    <!-- Recent Reviews -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-xl font-bold text-neutral-900 mb-6">≡ƒÆ¼ Review Terbaru</h2>
        <div class="space-y-4 max-h-96 overflow-y-auto">
            @forelse($recentReviews as $review)
                <div class="p-4 bg-neutral-50 rounded-lg border border-neutral-200">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <p class="font-bold text-neutral-900 text-sm">{{ $review->user->name }}</p>
                            <p class="text-xs text-neutral-500">{{ $review->product->name }}</p>
                        </div>
                        <div class="flex gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <span class="text-yellow-400 text-xs">Γ¡É</span>
                                @else
                                    <span class="text-neutral-300 text-xs">Γ¡É</span>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <p class="text-sm text-neutral-600 italic">"{{ $review->comment }}"</p>
                    <p class="text-xs text-neutral-400 mt-2">{{ $review->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-neutral-500 text-center py-8">Belum ada review</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
