@extends('layouts.app')

@section('title', 'Lacak Pesanan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-neutral-50 to-orange-50 py-12">
    <div class="max-w-3xl mx-auto px-4">
        <!-- Header Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-neutral-900 mb-2">📦 Lacak Pesanan Anda</h1>
                <p class="text-neutral-600">Masukkan nomor pesanan dan email untuk melacak status pengiriman</p>
            </div>

            <form action="{{ route('orders.track.submit') }}" method="POST" class="max-w-md mx-auto">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 mb-2">Nomor Pesanan</label>
                        <input type="text" name="order_number" placeholder="ORD-20231122-001" required
                            value="{{ old('order_number', request('order_number')) }}"
                            class="w-full px-4 py-3 border-2 border-neutral-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 mb-2">Email</label>
                        <input type="email" name="email" placeholder="email@example.com" required
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 border-2 border-neutral-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition">
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition">
                        🔍 Lacak Pesanan
                    </button>
                </div>
                @error('order_number')
                    <p class="mt-3 text-sm text-red-600 text-center">{{ $message }}</p>
                @enderror
                @error('email')
                    <p class="mt-3 text-sm text-red-600 text-center">{{ $message }}</p>
                @enderror
            </form>
        </div>

        @if(session('error'))
            <div class="bg-red-50 border-2 border-red-200 rounded-xl p-6 text-center mb-8">
                <p class="text-red-700 font-semibold">{{ session('error') }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
