@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-heading font-bold text-neutral-900 mb-4">Hubungi Kami</h1>
        <p class="text-neutral-600">Ada pertanyaan? Kami siap membantu Anda!</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <!-- Contact Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-start gap-4">
                    <div class="text-3xl">📧</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Email</h3>
                        <p class="text-neutral-600">info@jerukpin.com</p>
                        <p class="text-neutral-600">support@jerukpin.com</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-start gap-4">
                    <div class="text-3xl">📞</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Telepon</h3>
                        <p class="text-neutral-600">+62 812-3456-7890</p>
                        <p class="text-sm text-neutral-500">Senin - Sabtu, 08:00 - 17:00 WIB</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-start gap-4">
                    <div class="text-3xl">📍</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Alamat</h3>
                        <p class="text-neutral-600">Jl. Jeruk Manis No. 123</p>
                        <p class="text-neutral-600">Jakarta Selatan, 12345</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-bold mb-4">Kirim Pesan</h2>
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Nama</label>
                    <input type="text" class="w-full px-4 py-2 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500" placeholder="Nama Anda">
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Email</label>
                    <input type="email" class="w-full px-4 py-2 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500" placeholder="email@example.com">
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Pesan</label>
                    <textarea rows="4" class="w-full px-4 py-2 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500" placeholder="Tulis pesan Anda..."></textarea>
                </div>
                <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white py-3 rounded-lg font-bold">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
