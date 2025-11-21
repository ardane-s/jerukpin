@extends('layouts.app')

@section('title', 'Lacak Pesanan')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-8">
        <div class="text-6xl mb-4">📦</div>
        <h1 class="text-3xl font-heading font-bold text-neutral-900 mb-2">Lacak Pesanan</h1>
        <p class="text-neutral-600">Masukkan nomor pesanan dan email Anda</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('orders.track.submit') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-neutral-700 mb-2">Nomor Pesanan</label>
                <input type="text" name="order_number" placeholder="ORD-XXXXXXXXXX" required 
                    class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-neutral-700 mb-2">Email</label>
                <input type="email" name="email" placeholder="email@example.com" required 
                    class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
            </div>

            <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white py-3 rounded-lg font-bold">
                Lacak Pesanan
            </button>
        </form>
    </div>
</div>
@endsection
