@extends('admin.layouts.app')

@section('title', 'Edit Metode Pengiriman')
@section('page-title', 'Edit Metode Pengiriman')
@section('page-description', 'Edit metode pengiriman ' . $shippingMethod->name)

@section('content')
<div class="max-w-3xl">
    <form action="{{ route('admin.shipping-methods.update', $shippingMethod) }}" method="POST" class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <!-- Name -->
            <div>
                <label class="block text-sm font-semibold text-neutral-700 mb-2">Nama Metode Pengiriman</label>
                <input type="text" name="name" value="{{ old('name', $shippingMethod->name) }}" 
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition"
                       placeholder="Contoh: JNT Express" required>
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Code -->
            <div>
                <label class="block text-sm font-semibold text-neutral-700 mb-2">Kode (Unique)</label>
                <input type="text" name="code" value="{{ old('code', $shippingMethod->code) }}" 
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition font-mono"
                       placeholder="Contoh: jnt" required>
                <p class="text-xs text-neutral-500 mt-1">Gunakan huruf kecil tanpa spasi (contoh: jnt, gojek, own_driver)</p>
                @error('code')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-semibold text-neutral-700 mb-2">Deskripsi (Opsional)</label>
                <textarea name="description" rows="3" 
                          class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition"
                          placeholder="Deskripsi singkat metode pengiriman">{{ old('description', $shippingMethod->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Base Cost -->
            <div>
                <label class="block text-sm font-semibold text-neutral-700 mb-2">Biaya Dasar (Rp)</label>
                <input type="number" name="base_cost" value="{{ old('base_cost', $shippingMethod->base_cost) }}" min="0" step="1000"
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition"
                       placeholder="10000" required>
                <p class="text-xs text-neutral-500 mt-1">Masukkan 0 untuk gratis</p>
                @error('base_cost')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Icon -->
            <div>
                <label class="block text-sm font-semibold text-neutral-700 mb-2">Icon (Emoji)</label>
                <input type="text" name="icon" value="{{ old('icon', $shippingMethod->icon) }}" maxlength="10"
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition text-2xl"
                       placeholder="🚗">
                <p class="text-xs text-neutral-500 mt-1">Contoh: 🚗 📦 🏍️ 🚕 🛒 ⚡ 📮 📬</p>
                @error('icon')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Estimated Days -->
            <div>
                <label class="block text-sm font-semibold text-neutral-700 mb-2">Estimasi Pengiriman (Hari)</label>
                <input type="number" name="estimated_days" value="{{ old('estimated_days', $shippingMethod->estimated_days) }}" min="0" max="30"
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition"
                       placeholder="1" required>
                <p class="text-xs text-neutral-500 mt-1">0 = Hari ini, 1 = 1 hari, dst.</p>
                @error('estimated_days')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order -->
            <div>
                <label class="block text-sm font-semibold text-neutral-700 mb-2">Urutan Tampilan</label>
                <input type="number" name="order" value="{{ old('order', $shippingMethod->order) }}" min="0"
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition"
                       placeholder="0">
                <p class="text-xs text-neutral-500 mt-1">Semakin kecil angka, semakin di atas urutannya</p>
                @error('order')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Status -->
            <div class="flex items-center gap-3 p-4 bg-neutral-50 rounded-lg">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $shippingMethod->is_active) ? 'checked' : '' }}
                       class="w-5 h-5 text-orange-600 border-neutral-300 rounded focus:ring-2 focus:ring-orange-100">
                <label for="is_active" class="text-sm font-semibold text-neutral-700 cursor-pointer">
                    Aktifkan metode pengiriman ini
                </label>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-3 mt-8 pt-6 border-t border-neutral-200">
            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2.5 rounded-lg font-semibold transition">
                Update
            </button>
            <a href="{{ route('admin.shipping-methods.index') }}" class="bg-neutral-100 hover:bg-neutral-200 text-neutral-700 px-6 py-2.5 rounded-lg font-semibold transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
