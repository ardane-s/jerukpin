@extends('layouts.app')

@section('title', 'Diskon Spesial')

@section('content')
<div class="bg-neutral-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-neutral-900 mb-4">🏷️ Diskon Spesial</h1>
            <p class="text-lg text-neutral-600">Promo terbatas! Jangan sampai kehabisan!</p>
        </div>

        <!-- Flash Sale Banner -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-8 text-white mb-8 text-center">
            <h2 class="text-3xl font-bold mb-2">⚡ Flash Sale Hari Ini!</h2>
            <p class="text-lg mb-4">Diskon hingga 50% untuk produk pilihan</p>
            <a href="{{ route('flash-sale') }}" class="inline-block bg-white text-red-600 px-8 py-3 rounded-xl font-bold hover:shadow-lg transition">
                Lihat Flash Sale →
            </a>
        </div>

        <!-- Special Offers Grid -->
        <div class="grid md:grid-cols-2 gap-8 mb-12">
            <!-- New Customer Offer -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex items-start gap-4 mb-6">
                    <div class="text-5xl">🎉</div>
                    <div>
                        <h3 class="text-2xl font-bold text-neutral-900 mb-2">Diskon Pelanggan Baru</h3>
                        <p class="text-neutral-600">Khusus untuk pembelian pertama</p>
                    </div>
                </div>
                <div class="bg-orange-50 rounded-xl p-6 mb-6">
                    <div class="text-center">
                        <div class="text-5xl font-bold text-orange-600 mb-2">15%</div>
                        <p class="text-neutral-700 font-semibold">Diskon untuk semua produk</p>
                    </div>
                </div>
                <ul class="space-y-2 mb-6">
                    <li class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Berlaku untuk semua produk</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Minimal pembelian Rp 50.000</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Kode: NEWCUST15</span>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-3 rounded-xl font-bold text-center hover:shadow-lg transition">
                    Daftar Sekarang
                </a>
            </div>

            <!-- Weekend Sale -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex items-start gap-4 mb-6">
                    <div class="text-5xl">🎊</div>
                    <div>
                        <h3 class="text-2xl font-bold text-neutral-900 mb-2">Weekend Sale</h3>
                        <p class="text-neutral-600">Setiap akhir pekan</p>
                    </div>
                </div>
                <div class="bg-purple-50 rounded-xl p-6 mb-6">
                    <div class="text-center">
                        <div class="text-5xl font-bold text-purple-600 mb-2">20%</div>
                        <p class="text-neutral-700 font-semibold">Diskon Sabtu-Minggu</p>
                    </div>
                </div>
                <ul class="space-y-2 mb-6">
                    <li class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Berlaku Sabtu-Minggu</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Produk pilihan</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Kode: WEEKEND20</span>
                    </li>
                </ul>
                <a href="{{ route('home') }}" class="block w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white py-3 rounded-xl font-bold text-center hover:shadow-lg transition">
                    Belanja Sekarang
                </a>
            </div>

            <!-- Bulk Purchase -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex items-start gap-4 mb-6">
                    <div class="text-5xl">📦</div>
                    <div>
                        <h3 class="text-2xl font-bold text-neutral-900 mb-2">Diskon Pembelian Banyak</h3>
                        <p class="text-neutral-600">Makin banyak, makin hemat!</p>
                    </div>
                </div>
                <div class="space-y-3 mb-6">
                    <div class="bg-green-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-semibold">Beli 5kg</span>
                        <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-bold">10% OFF</span>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-semibold">Beli 10kg</span>
                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-bold">20% OFF</span>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-semibold">Beli 20kg+</span>
                        <span class="bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-bold">30% OFF</span>
                    </div>
                </div>
                <a href="{{ route('home') }}" class="block w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-xl font-bold text-center hover:shadow-lg transition">
                    Mulai Belanja
                </a>
            </div>

            <!-- Loyalty Reward -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex items-start gap-4 mb-6">
                    <div class="text-5xl">⭐</div>
                    <div>
                        <h3 class="text-2xl font-bold text-neutral-900 mb-2">Reward Pelanggan Setia</h3>
                        <p class="text-neutral-600">Belanja rutin dapat poin</p>
                    </div>
                </div>
                <div class="bg-yellow-50 rounded-xl p-6 mb-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-600 mb-2">1 Poin = Rp 1.000</div>
                        <p class="text-neutral-700 text-sm">Setiap pembelian Rp 10.000 dapat 1 poin</p>
                    </div>
                </div>
                <ul class="space-y-2 mb-6">
                    <li class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Tukar poin jadi diskon</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Poin tidak expire</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        <span>Gratis membership</span>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full bg-gradient-to-r from-yellow-500 to-yellow-600 text-white py-3 rounded-xl font-bold text-center hover:shadow-lg transition">
                    Gabung Sekarang
                </a>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-2xl p-8 text-center">
            <h2 class="text-3xl font-bold text-neutral-900 mb-4">Jangan Lewatkan Promo Kami!</h2>
            <p class="text-neutral-700 mb-6">Daftar newsletter untuk mendapatkan info promo terbaru</p>
            <div class="flex gap-3 max-w-md mx-auto">
                <input type="email" placeholder="Email Anda" 
                    class="flex-1 px-4 py-3 rounded-xl border-2 border-neutral-200 focus:border-orange-500">
                <button class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-xl font-bold hover:shadow-lg transition">
                    Subscribe
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
