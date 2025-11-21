@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-heading font-bold text-neutral-900 mb-4">Tentang JerukPin</h1>
        <p class="text-xl text-neutral-600">Jeruk Segar Berkualitas dari Kebun ke Rumah Anda</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
        <h2 class="text-2xl font-bold text-neutral-900 mb-4">Cerita Kami</h2>
        <p class="text-neutral-600 mb-4">
            JerukPin didirikan dengan misi sederhana: menghadirkan jeruk segar berkualitas tinggi langsung dari kebun ke meja makan Anda. Kami bekerja sama dengan petani lokal terpilih untuk memastikan setiap jeruk yang kami jual memenuhi standar kualitas tertinggi.
        </p>
        <p class="text-neutral-600 mb-4">
            Dengan pengalaman lebih dari 10 tahun di industri buah-buahan, kami memahami pentingnya kesegaran dan kualitas. Setiap jeruk dipilih dengan teliti, dikemas dengan hati-hati, dan dikirim dengan cepat untuk memastikan Anda mendapatkan produk terbaik.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg shadow-lg p-6 text-white text-center">
            <div class="text-4xl mb-3">🍊</div>
            <h3 class="text-2xl font-bold mb-2">100%</h3>
            <p class="text-sm opacity-90">Jeruk Segar</p>
        </div>
        <div class="bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-lg shadow-lg p-6 text-white text-center">
            <div class="text-4xl mb-3">🚚</div>
            <h3 class="text-2xl font-bold mb-2">24 Jam</h3>
            <p class="text-sm opacity-90">Pengiriman Cepat</p>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white text-center">
            <div class="text-4xl mb-3">⭐</div>
            <h3 class="text-2xl font-bold mb-2">10+</h3>
            <p class="text-sm opacity-90">Tahun Pengalaman</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-8">
        <h2 class="text-2xl font-bold text-neutral-900 mb-4">Nilai-Nilai Kami</h2>
        <div class="space-y-4">
            <div class="flex gap-4">
                <div class="text-2xl">✓</div>
                <div>
                    <h3 class="font-bold text-lg">Kualitas Terjamin</h3>
                    <p class="text-neutral-600">Setiap jeruk dipilih dengan standar kualitas tertinggi</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="text-2xl">✓</div>
                <div>
                    <h3 class="font-bold text-lg">Harga Terjangkau</h3>
                    <p class="text-neutral-600">Harga langsung dari petani tanpa perantara</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="text-2xl">✓</div>
                <div>
                    <h3 class="font-bold text-lg">Pelayanan Terbaik</h3>
                    <p class="text-neutral-600">Tim kami siap membantu Anda 24/7</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
