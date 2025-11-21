@extends('layouts.app')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-green-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header with Breadcrumb -->
        <div class="mb-6">
            <nav class="flex items-center gap-2 text-sm text-neutral-600 mb-4">
                <a href="{{ route('home') }}" class="hover:text-orange-600 transition">🏠 Beranda</a>
                <span>›</span>
                <a href="{{ route('orders.show', $order->order_number) }}" class="hover:text-orange-600 transition">Detail Pesanan</a>
                <span>›</span>
                <span class="text-neutral-900 font-medium">Upload Bukti Pembayaran</span>
            </nav>
            <h1 class="text-3xl font-heading font-bold text-neutral-900">📤 Upload Bukti Pembayaran</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left: Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg border-2 border-orange-100 p-6">
                    <form action="{{ route('orders.payment.store', $order->order_number) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Upload Image Section -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-neutral-900 mb-3 flex items-center gap-2">
                                <span>📸</span> Bukti Transfer *
                            </label>
                            <div class="border-2 border-dashed border-orange-300 rounded-xl p-8 text-center bg-gradient-to-br from-orange-50 to-white hover:border-orange-500 transition">
                                <div class="mb-4">
                                    <svg class="w-16 h-16 mx-auto text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <input type="file" name="proof_image" accept="image/*" required 
                                    class="w-full text-sm text-neutral-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-orange-500 file:text-white hover:file:bg-orange-600 cursor-pointer"
                                    onchange="previewImage(event)">
                                <p class="text-xs text-neutral-500 mt-2">Format: JPG, PNG, GIF. Maksimal 5MB</p>
                                @error('proof_image')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Image Preview -->
                            <div id="imagePreview" class="hidden mt-4">
                                <img id="preview" class="w-full h-64 object-contain rounded-xl border-2 border-orange-200 bg-neutral-50">
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="bg-gradient-to-r from-orange-50 to-white rounded-xl p-5 border border-orange-100 mb-6">
                            <h3 class="font-bold text-neutral-900 mb-4 flex items-center gap-2">
                                <span>💰</span> Detail Pembayaran
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-neutral-700 mb-2">Tanggal Transfer *</label>
                                    <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" required 
                                        class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition">
                                    @error('payment_date')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-neutral-700 mb-2">Jumlah Transfer (Rp) *</label>
                                    <input type="number" name="payment_amount" value="{{ $order->total }}" required 
                                        class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition">
                                    @error('payment_amount')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-neutral-700 mb-2">Nama Bank *</label>
                                    <select name="bank_name" id="bank_name" required 
                                        class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition bg-white"
                                        onchange="toggleOtherBank()">
                                        <option value="">Pilih Bank</option>
                                        <option value="BCA">BCA (Bank Central Asia)</option>
                                        <option value="BNI">BNI (Bank Negara Indonesia)</option>
                                        <option value="BRI">BRI (Bank Rakyat Indonesia)</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="CIMB Niaga">CIMB Niaga</option>
                                        <option value="Permata">Permata Bank</option>
                                        <option value="Danamon">Danamon</option>
                                        <option value="BTN">BTN (Bank Tabungan Negara)</option>
                                        <option value="BSI">BSI (Bank Syariah Indonesia)</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    @error('bank_name')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                    
                                    <!-- Other Bank Input (Hidden by default) -->
                                    <div id="other_bank_container" class="hidden mt-3">
                                        <input type="text" name="other_bank_name" id="other_bank_name" 
                                            placeholder="Masukkan nama bank lainnya"
                                            class="w-full px-4 py-3 border-2 border-orange-300 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition bg-orange-50">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-neutral-700 mb-2">Atas Nama *</label>
                                    <input type="text" name="account_name" placeholder="Nama pemilik rekening" required 
                                        class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition">
                                    @error('account_name')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <a href="{{ route('orders.show', $order->order_number) }}" 
                                class="px-6 py-3 border-2 border-neutral-300 rounded-lg text-neutral-700 hover:bg-neutral-50 font-bold transition">
                                ← Kembali
                            </a>
                            <button type="submit" class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-3 rounded-lg font-bold transition shadow-md hover:shadow-lg">
                                ✅ Upload Bukti Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border-2 border-orange-100 p-6 sticky top-20">
                    <h2 class="text-xl font-bold text-neutral-900 mb-4 flex items-center gap-2">
                        <span>📋</span> Ringkasan Pesanan
                    </h2>
                    
                    <div class="bg-gradient-to-r from-orange-50 to-white rounded-xl p-4 border border-orange-100 mb-4">
                        <p class="text-sm text-neutral-600 mb-1">Nomor Pesanan</p>
                        <p class="text-lg font-bold text-neutral-900">{{ $order->order_number }}</p>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between text-neutral-700">
                            <span>Subtotal</span>
                            <span class="font-medium">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-neutral-700">
                            <span>Ongkos Kirim</span>
                            <span class="font-medium">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t-2 border-dashed border-neutral-200 pt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-neutral-900">Total</span>
                                <span class="text-2xl font-bold text-orange-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    @if($order->payment_method)
                        <div class="bg-neutral-50 p-4 rounded-xl mt-4">
                            <p class="text-sm text-neutral-600 mb-1">Metode Pembayaran</p>
                            <p class="font-bold text-neutral-900">
                                @if($order->payment_method == 'bank_transfer')
                                    🏦 Transfer Bank
                                @elseif($order->payment_method == 'e_wallet')
                                    📱 E-Wallet
                                @else
                                    💵 COD
                                @endif
                            </p>
                        </div>
                    @endif

                    <!-- Important Note -->
                    <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-4 mt-4">
                        <p class="text-sm font-bold text-yellow-900 mb-2">⚠️ Penting!</p>
                        <ul class="text-xs text-yellow-800 space-y-1">
                            <li>• Pastikan jumlah transfer sesuai dengan total pesanan</li>
                            <li>• Upload bukti transfer yang jelas dan terbaca</li>
                            <li>• Pembayaran akan diverifikasi dalam 1x24 jam</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function toggleOtherBank() {
    const bankSelect = document.getElementById('bank_name');
    const otherBankContainer = document.getElementById('other_bank_container');
    const otherBankInput = document.getElementById('other_bank_name');
    
    if (bankSelect.value === 'Lainnya') {
        otherBankContainer.classList.remove('hidden');
        otherBankInput.required = true;
    } else {
        otherBankContainer.classList.add('hidden');
        otherBankInput.required = false;
        otherBankInput.value = '';
    }
}
</script>
@endsection
