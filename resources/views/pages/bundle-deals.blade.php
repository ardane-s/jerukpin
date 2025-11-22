@extends('layouts.app')

@section('title', 'Promo Bundle Deals')

@section('content')
<div class="bg-neutral-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-neutral-900 mb-4">🎁 Bundle Deals Spesial</h1>
            <p class="text-lg text-neutral-600">Hemat lebih banyak dengan paket bundling kami!</p>
        </div>

        <!-- Bundle Packages -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Bundle 1: Family Pack -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-6">
                    <h3 class="text-2xl font-bold mb-2">Family Pack</h3>
                    <p class="text-orange-100">Paket keluarga hemat</p>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        <div class="text-4xl mb-4">🏠</div>
                        <div class="text-sm text-neutral-500 line-through mb-2">Rp 150.000</div>
                        <div class="text-3xl font-bold text-orange-600">Rp 120.000</div>
                        <div class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold mt-2">
                            Hemat 20%
                        </div>
                    </div>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>2kg Es Jeruk Original</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>1kg Es Jeruk Sunkist</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>1kg Es Lemon</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>Gratis ongkir</span>
                        </li>
                    </ul>
                    <a href="{{ route('home') }}" class="block w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-3 rounded-xl font-bold text-center hover:shadow-lg transition">
                        Beli Sekarang
                    </a>
                </div>
            </div>

            <!-- Bundle 2: Health Pack -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition border-2 border-orange-500">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Health Pack</h3>
                            <p class="text-green-100">Terlaris minggu ini!</p>
                        </div>
                        <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-xs font-bold">BEST SELLER</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        <div class="text-4xl mb-4">💪</div>
                        <div class="text-sm text-neutral-500 line-through mb-2">Rp 200.000</div>
                        <div class="text-3xl font-bold text-green-600">Rp 155.000</div>
                        <div class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold mt-2">
                            Hemat 22%
                        </div>
                    </div>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>3kg Es Jeruk Lokal</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>2kg Es Lemon</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>Bonus resep jus sehat</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>Gratis ongkir</span>
                        </li>
                    </ul>
                    <a href="{{ route('home') }}" class="block w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-xl font-bold text-center hover:shadow-lg transition">
                        Beli Sekarang
                    </a>
                </div>
            </div>

            <!-- Bundle 3: Premium Pack -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6">
                    <h3 class="text-2xl font-bold mb-2">Premium Pack</h3>
                    <p class="text-purple-100">Kualitas terbaik</p>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        <div class="text-4xl mb-4">⭐</div>
                        <div class="text-sm text-neutral-500 line-through mb-2">Rp 250.000</div>
                        <div class="text-3xl font-bold text-purple-600">Rp 199.000</div>
                        <div class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold mt-2">
                            Hemat 20%
                        </div>
                    </div>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>2kg Es Jeruk Sunkist</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>2kg Es Jeruk dengan Nata de Coco</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>1kg Es Lemon</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>Packaging premium</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>Gratis ongkir</span>
                        </li>
                    </ul>
                    <a href="{{ route('home') }}" class="block w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white py-3 rounded-xl font-bold text-center hover:shadow-lg transition">
                        Beli Sekarang
                    </a>
                </div>
            </div>
        </div>

        <!-- Benefits -->
        <div class="mt-16 bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-neutral-900 mb-6 text-center">Keuntungan Bundle Deals</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-4xl mb-3">💰</div>
                    <h3 class="font-bold text-lg mb-2">Hemat Hingga 30%</h3>
                    <p class="text-sm text-neutral-600">Harga lebih murah dibanding beli satuan</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-3">🚚</div>
                    <h3 class="font-bold text-lg mb-2">Gratis Ongkir</h3>
                    <p class="text-sm text-neutral-600">Semua paket bundle gratis ongkir</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-3">🎁</div>
                    <h3 class="font-bold text-lg mb-2">Bonus Eksklusif</h3>
                    <p class="text-sm text-neutral-600">Dapat bonus spesial setiap pembelian bundle</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
