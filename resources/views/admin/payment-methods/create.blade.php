@extends('admin.layouts.app')

@section('title', 'Tambah Metode Pembayaran')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.payment-methods.index') }}" class="text-orange-600 hover:text-orange-800">← Kembali</a>
    </div>

    <h1 class="text-3xl font-heading font-bold text-neutral-900 mb-6">Tambah Metode Pembayaran</h1>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('admin.payment-methods.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-bold text-neutral-700 mb-2">Tipe Pembayaran *</label>
                <select name="type" id="paymentType" required
                    class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition">
                    <option value="">Pilih Tipe...</option>
                    <option value="bank_transfer" {{ old('type') == 'bank_transfer' ? 'selected' : '' }}>💳 Transfer Bank</option>
                    <option value="e_wallet" {{ old('type') == 'e_wallet' ? 'selected' : '' }}>📱 E-Wallet / QRIS</option>
                    <option value="cod" {{ old('type') == 'cod' ? 'selected' : '' }}>💵 Bayar di Tempat (C OD)</option>
                </select>
                @error('type')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-neutral-700 mb-2">Nama Metode *</label>
                <input type="text" name="method_name" value="{{ old('method_name') }}" required
                    class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition"
                    placeholder="Contoh: BCA, GoPay, Dana, COD">
                <p class="text-xs text-neutral-500 mt-1" id="methodNameHelp">Contoh: BCA, Mandiri untuk bank</p>
                @error('method_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4" id="accountInfoField">
                <label class="block text-sm font-bold text-neutral-700 mb-2">Info Akun <span class="text-neutral-400">(Opsional)</span></label>
                <input type="text" name="account_info" value="{{ old('account_info') }}"
                    class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition"
                    placeholder="No. Rekening / No. HP">
                <p class="text-xs text-neutral-500 mt-1" id="accountInfoHelp">Contoh: 1234567890 untuk bank, 08123456789 untuk e-wallet</p>
                @error('account_info')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4" id="accountNameField">
                <label class="block text-sm font-bold text-neutral-700 mb-2">Atas Nama <span class="text-neutral-400">(Opsional)</span></label>
                <input type="text" name="account_name" value="{{ old('account_name') }}"
                    class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition"
                    placeholder="Atas Nama Akun">
                <p class="text-xs text-neutral-500 mt-1" id="accountNameHelp">Contoh: JerukPin Indonesia atau PT Toko Jeruk</p>
                @error('account_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 text-orange-600 rounded">
                    <span class="ml-2 text-sm font-medium text-neutral-700">Aktifkan metode pembayaran ini</span>
                </label>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.payment-methods.index') }}" class="px-6 py-3 border-2 border-neutral-300 rounded-lg text-neutral-700 hover:bg-neutral-50 font-bold transition">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-3 rounded-lg font-bold shadow-md hover:shadow-lg transition">
                    Simpan Metode Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('paymentType').addEventListener('change', function() {
    const type = this.value;
    const methodNameHelp = document.getElementById('methodNameHelp');
    const accountInfoHelp = document.getElementById('accountInfoHelp');
    const accountNameHelp = document.getElementById('accountNameHelp');
    const accountInfoField = document.getElementById('accountInfoField');
    const accountNameField = document.getElementById('accountNameField');
    
    if (type === 'bank_transfer') {
        methodNameHelp.textContent = 'Contoh: BCA, BNI, Mandiri, BRI';
        accountInfoHelp.textContent = 'No. Rekening - Contoh: 1234567890';
        accountNameHelp.textContent = 'Atas Nama Rekening - Cont oh: JerukPin Indonesia';
        accountInfoField.style.display = 'block';
        accountNameField.style.display = 'block';
    } else if (type === 'e_wallet') {
        methodNameHelp.textContent = 'Contoh: GoPay, OVO, DANA, ShopeePay, QRIS';
        accountInfoHelp.textContent = 'No. HP / Merchant ID - Contoh: 08123456789';
        accountNameHelp.textContent = 'Atas Nama Akun - Contoh: Toko JerukPin';
        accountInfoField.style.display = 'block';
        accountNameField.style.display = 'block';
    } else if (type === 'cod') {
        methodNameHelp.textContent = 'Nama: Cash on Delivery / Bayar di Tempat';
        accountInfoField.style.display = 'none';
        accountNameField.style.display = 'none';
    }
});
</script>
@endsection
