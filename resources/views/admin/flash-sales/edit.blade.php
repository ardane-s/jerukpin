@extends('admin.layouts.app')

@section('title', 'Edit Flash Sale')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-3xl font-heading font-bold text-neutral-900 mb-6">Edit Flash Sale</h1>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="mb-4 p-4 bg-neutral-50 rounded-lg">
            <div class="text-sm font-medium">{{ $flashSale->productVariant->product->name }}</div>
            <div class="text-sm text-neutral-600">{{ $flashSale->productVariant->variant_name }}</div>
        </div>

        <form action="{{ route('admin.flash-sales.update', $flashSale) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Harga Flash Sale (Rp) *</label>
                    <input type="number" name="flash_price" value="{{ $flashSale->flash_price }}" required min="0"
                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
                    <p class="text-xs text-neutral-500 mt-1">Harga normal: Rp {{ number_format($flashSale->original_price, 0, ',', '.') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Stok Flash Sale *</label>
                    <input type="number" name="flash_stock" value="{{ $flashSale->flash_stock }}" required min="1"
                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
                    <p class="text-xs text-neutral-500 mt-1">Terjual: {{ $flashSale->flash_sold }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Waktu Mulai *</label>
                    <input type="datetime-local" name="start_time" value="{{ $flashSale->start_time->format('Y-m-d\TH:i') }}" required
                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Waktu Berakhir *</label>
                    <input type="datetime-local" name="end_time" value="{{ $flashSale->end_time->format('Y-m-d\TH:i') }}" required
                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
                </div>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ $flashSale->is_active ? 'checked' : '' }}
                        class="rounded border-neutral-300 text-primary-600">
                    <span class="ml-2 text-sm">Aktifkan flash sale</span>
                </label>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.flash-sales.index') }}" class="px-6 py-2 border border-neutral-300 rounded-lg text-neutral-700 hover:bg-neutral-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-lg font-medium">
                    Update Flash Sale
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
