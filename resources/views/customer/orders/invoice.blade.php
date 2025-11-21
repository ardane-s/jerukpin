<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->order_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body class="bg-white">
    <div class="max-w-4xl mx-auto p-8">
        <!-- Print Button -->
        <div class="no-print mb-6 flex justify-between items-center">
            <a href="{{ route('orders.show', $order->order_number) }}" class="text-orange-600 hover:text-orange-700 font-bold">
                ← Kembali ke Detail Pesanan
            </a>
            <button onclick="window.print()" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-bold transition shadow-md">
                🖨️ Print Invoice
            </button>
        </div>

        <!-- Invoice Header -->
        <div class="border-b-4 border-orange-500 pb-6 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-4xl font-bold text-orange-600 mb-2">🍊 JerukPin</h1>
                    <p class="text-neutral-600">Jeruk Segar Berkualitas</p>
                    <p class="text-sm text-neutral-500 mt-2">
                        Jl. Contoh No. 123, Jakarta<br>
                        Telp: (021) 1234-5678<br>
                        Email: info@jerukpin.com
                    </p>
                </div>
                <div class="text-right">
                    <h2 class="text-3xl font-bold text-neutral-900 mb-2">INVOICE</h2>
                    <p class="text-sm text-neutral-600">
                        <span class="font-bold">No. Invoice:</span> {{ $order->order_number }}<br>
                        <span class="font-bold">Tanggal:</span> {{ $order->created_at->format('d M Y') }}<br>
                        <span class="font-bold">Status:</span> 
                        @if($order->status == 'delivered')
                            <span class="text-green-600 font-bold">✅ Selesai</span>
                        @elseif($order->status == 'shipped')
                            <span class="text-blue-600 font-bold">🚚 Dikirim</span>
                        @elseif($order->status == 'processing')
                            <span class="text-indigo-600 font-bold">⚙️ Diproses</span>
                        @else
                            <span class="text-purple-600 font-bold">✅ Terverifikasi</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-neutral-900 mb-3 border-b-2 border-neutral-200 pb-2">Informasi Pelanggan</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-neutral-600 font-bold">Nama:</p>
                    <p class="text-neutral-900">{{ $order->user_id ? $order->user->name : $order->guest_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-neutral-600 font-bold">Telepon:</p>
                    <p class="text-neutral-900">{{ $order->user_id ? ($order->user->phone ?? '-') : $order->guest_phone }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-sm text-neutral-600 font-bold">Alamat Pengiriman:</p>
                    <p class="text-neutral-900">{{ $order->user_id ? ($order->address ? $order->address->full_address : '-') : $order->guest_address }}</p>
                </div>
                @if(!$order->user_id)
                <div>
                    <p class="text-sm text-neutral-600 font-bold">Email:</p>
                    <p class="text-neutral-900">{{ $order->guest_email }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-neutral-900 mb-3 border-b-2 border-neutral-200 pb-2">Detail Pesanan</h3>
            <table class="w-full">
                <thead class="bg-neutral-100">
                    <tr>
                        <th class="text-left p-3 font-bold text-neutral-900">Produk</th>
                        <th class="text-center p-3 font-bold text-neutral-900">Qty</th>
                        <th class="text-right p-3 font-bold text-neutral-900">Harga</th>
                        <th class="text-right p-3 font-bold text-neutral-900">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr class="border-b border-neutral-200">
                        <td class="p-3">
                            <p class="font-bold text-neutral-900">{{ $item->product_name }}</p>
                            <p class="text-sm text-neutral-600">{{ $item->variant_name }}</p>
                            @if($item->is_flash_sale)
                                <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold">🔥 Flash Sale</span>
                            @endif
                        </td>
                        <td class="p-3 text-center text-neutral-900">{{ $item->quantity }}</td>
                        <td class="p-3 text-right text-neutral-900">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="p-3 text-right font-bold text-neutral-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-neutral-300">
                        <td colspan="3" class="p-3 text-right font-bold text-neutral-900">Subtotal:</td>
                        <td class="p-3 text-right font-bold text-neutral-900">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="p-3 text-right font-bold text-neutral-900">Ongkos Kirim:</td>
                        <td class="p-3 text-right font-bold text-neutral-900">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="bg-orange-50 border-t-2 border-orange-300">
                        <td colspan="3" class="p-3 text-right text-lg font-bold text-neutral-900">TOTAL:</td>
                        <td class="p-3 text-right text-xl font-bold text-orange-600">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Payment Info -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-neutral-900 mb-3 border-b-2 border-neutral-200 pb-2">Informasi Pembayaran</h3>
            <div class="bg-neutral-50 p-4 rounded-lg">
                <p class="text-sm text-neutral-600 mb-1">Metode Pembayaran:</p>
                <p class="font-bold text-neutral-900">
                    @if($order->payment_method == 'bank_transfer')
                        🏦 Transfer Bank
                    @elseif($order->payment_method == 'e_wallet')
                        📱 E-Wallet (GoPay/OVO/Dana)
                    @else
                        💵 Cash On Delivery (COD)
                    @endif
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-12 pt-6 border-t-2 border-neutral-200 text-center text-sm text-neutral-600">
            <p class="font-bold text-neutral-900 mb-2">Terima kasih atas pesanan Anda!</p>
            <p>Invoice ini dicetak secara otomatis dan sah tanpa tanda tangan.</p>
            <p class="mt-2">Untuk pertanyaan, hubungi kami di info@jerukpin.com atau (021) 1234-5678</p>
        </div>
    </div>
</body>
</html>
