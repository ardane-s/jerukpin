@extends('admin.layouts.app')

@section('title', 'Tambah Metode Pembayaran')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('admin.payment-methods.index') }}" class="text-orange-600 hover:text-orange-800">← Kembali</a>
    </div>

    <h1 class="text-3xl font-heading font-bold text-neutral-900 mb-6">Tambah Metode Pembayaran</h1>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Payment Type -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-neutral-700 mb-2">Tipe Pembayaran *</label>
                <select name="type" id="paymentType" required
                    class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition">
                    <option value="">Pilih Tipe...</option>
                    <option value="bank_transfer" {{ old('type') == 'bank_transfer' ? 'selected' : '' }}>💳 Transfer Bank</option>
                    <option value="e_wallet" {{ old('type') == 'e_wallet' ? 'selected' : '' }}>📱 E-Wallet / QRIS</option>
                    <option value="cod" {{ old('type') == 'cod' ? 'selected' : '' }}>💵 Bayar di Tempat (COD)</option>
                </select>
                @error('type')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Method Name -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-neutral-700 mb-2">Nama Metode *</label>
                <input type="text" name="method_name" value="{{ old('method_name') }}" required
                    class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition"
                    placeholder="Contoh: BCA, GoPay, Dana, COD">
                <p class="text-xs text-neutral-500 mt-1" id="methodNameHelp">Nama yang akan ditampilkan ke customer</p>
                @error('method_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Account Info (conditional) -->
            <div class="mb-6" id="accountInfoField">
                <label class="block text-sm font-bold text-neutral-700 mb-2">Info Akun <span class="text-neutral-400">(Opsional)</span></label>
                <input type="text" name="account_info" value="{{ old('account_info') }}"
                    class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition"
                    placeholder="No. Rekening / No. HP">
                <p class="text-xs text-neutral-500 mt-1" id="accountInfoHelp">Nomor rekening atau nomor HP</p>
                @error('account_info')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Account Name (conditional) -->
            <div class="mb-6" id="accountNameField">
                <label class="block text-sm font-bold text-neutral-700 mb-2">Atas Nama <span class="text-neutral-400">(Opsional)</span></label>
                <input type="text" name="account_name" value="{{ old('account_name') }}"
                    class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition"
                    placeholder="Atas Nama Akun">
                <p class="text-xs text-neutral-500 mt-1" id="accountNameHelp">Nama pemilik rekening atau akun</p>
                @error('account_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- QR Image Upload (for e_wallet) -->
            <div class="mb-6 hidden" id="qrImageField">
                <label class="block text-sm font-bold text-neutral-700 mb-2">Upload QR Code <span class="text-neutral-400">(Opsional)</span></label>
                <div class="border-2 border-dashed border-neutral-300 rounded-lg p-6 text-center hover:border-orange-500 transition">
                    <input type="file" name="qr_image" id="qrImageInput" accept="image/*" class="hidden">
                    <label for="qrImageInput" class="cursor-pointer">
                        <div class="text-orange-600 mb-2">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-neutral-600 font-medium">Klik untuk upload QR Code</p>
                        <p class="text-xs text-neutral-500 mt-1">PNG, JPG hingga 2MB</p>
                    </label>
                </div>
                <div id="qrPreview" class="mt-4 hidden">
                    <img id="qrPreviewImage" class="max-w-xs mx-auto rounded-lg border-2 border-neutral-200">
                </div>
                @error('qr_image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Instructions -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-neutral-700 mb-2">Instruksi Pembayaran <span class="text-neutral-400">(Opsional)</span></label>
                <textarea name="instructions" rows="4"
                    class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition"
                    placeholder="Contoh: Transfer ke rekening di atas, lalu upload bukti transfer...">{{ old('instructions') }}</textarea>
                <p class="text-xs text-neutral-500 mt-1">Instruksi khusus untuk customer saat melakukan pembayaran</p>
                @error('instructions')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Status -->
            <div class="mb-6">
                <label class="flex items-center p-4 bg-orange-50 border-2 border-orange-200 rounded-lg cursor-pointer hover:bg-orange-100 transition">
                    <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 text-orange-600 rounded">
                    <span class="ml-3 text-sm font-bold text-neutral-800">✓ Aktifkan metode pembayaran ini</span>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <a href="{{ route('admin.payment-methods.index') }}" class="px-6 py-3 border-2 border-neutral-300 rounded-lg text-neutral-700 hover:bg-neutral-50 font-bold transition">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-3 rounded-lg font-bold shadow-md hover:shadow-lg transition">
                    💾 Simpan Metode Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Payment type change handler
document.getElementById('paymentType').addEventListener('change', function() {
    const type = this.value;
    const accountInfoField = document.getElementById('accountInfoField');
    const accountNameField = document.getElementById('accountNameField');
    const qrImageField = document.getElementById('qrImageField');
    const methodNameHelp = document.getElementById('methodNameHelp');
    const accountInfoHelp = document.getElementById('accountInfoHelp');
    const accountNameHelp = document.getElementById('accountNameHelp');
    
    if (type === 'bank_transfer') {
        methodNameHelp.textContent = 'Contoh: BCA, BNI, Mandiri, BRI';
        accountInfoHelp.textContent = 'No. Rekening - Contoh: 1234567890';
        accountNameHelp.textContent = 'Atas Nama Rekening - Contoh: PT JerukPin Indonesia';
        accountInfoField.classList.remove('hidden');
        accountNameField.classList.remove('hidden');
        qrImageField.classList.add('hidden');
    } else if (type === 'e_wallet') {
        methodNameHelp.textContent = 'Contoh: GoPay, OVO, DANA, ShopeePay, QRIS';
        accountInfoHelp.textContent = 'No. HP / Merchant ID - Contoh: 08123456789';
        accountNameHelp.textContent = 'Atas Nama Akun - Contoh: Toko JerukPin';
        accountInfoField.classList.remove('hidden');
        accountNameField.classList.remove('hidden');
        qrImageField.classList.remove('hidden');
    } else if (type === 'cod') {
        methodNameHelp.textContent = 'Nama: Cash on Delivery / Bayar di Tempat';
        accountInfoField.classList.add('hidden');
        accountNameField.classList.add('hidden');
        qrImageField.classList.add('hidden');
    }
});

// QR Image preview
document.getElementById('qrImageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('qrPreviewImage').src = e.target.result;
            document.getElementById('qrPreview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
