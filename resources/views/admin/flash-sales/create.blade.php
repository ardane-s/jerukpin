@extends('admin.layouts.app')

@section('title', 'Buat Flash Sale')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-3xl font-heading font-bold text-neutral-900 mb-6">Buat Flash Sale Baru</h1>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('admin.flash-sales.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-neutral-700 mb-2">Pilih Varian Produk *</label>
                <select name="product_variant_id" required class="w-full px-4 py-2 border border-neutral-300 rounded-lg" id="variant-select">
                    <option value="">-- Pilih Varian --</option>
                    @foreach($availableVariants as $variant)
                        <option value="{{ $variant->id }}" data-price="{{ $variant->price }}" data-stock="{{ $variant->stock }}">
                            {{ $variant->product->name }} - {{ $variant->variant_name }} (Rp {{ number_format($variant->price, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
                @error('product_variant_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Harga Flash Sale (Rp) *</label>
                    <input type="number" name="flash_price" id="flash_price" required min="0"
                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
                    <p class="text-xs text-neutral-500 mt-1">Harga normal: <span id="original-price">-</span></p>
                    @error('flash_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Stok Flash Sale *</label>
                    <input type="number" name="flash_stock" id="flash_stock" required min="1"
                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
                    <p class="text-xs text-neutral-500 mt-1">Stok tersedia: <span id="available-stock">-</span></p>
                    @error('flash_stock')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Waktu Mulai *</label>
                    <input type="datetime-local" name="start_time" required
                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
                    @error('start_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Waktu Berakhir *</label>
                    <input type="datetime-local" name="end_time" required
                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
                    @error('end_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.flash-sales.index') }}" class="px-6 py-2 border border-neutral-300 rounded-lg text-neutral-700 hover:bg-neutral-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-lg font-medium">
                    Buat Flash Sale
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('variant-select').addEventListener('change', function(e) {
    const option = e.target.selectedOptions[0];
    const price = option.dataset.price;
    const stock = option.dataset.stock;
    
    document.getElementById('original-price').textContent = price ? 'Rp ' + parseInt(price).toLocaleString('id-ID') : '-';
    document.getElementById('available-stock').textContent = stock || '-';
    
    if (price) {
        document.getElementById('flash_price').max = price;
    }
    if (stock) {
        document.getElementById('flash_stock').max = stock;
    }
});
</script>
@endsection
