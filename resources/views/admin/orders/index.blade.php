@extends('admin.layouts.app')

@section('title', 'Pesanan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-heading font-bold text-neutral-900">Pesanan</h1>
</div>

<!-- Filter -->
<div class="bg-white rounded-lg shadow-sm p-4 mb-6">
    <form action="{{ route('admin.orders.index') }}" method="GET" class="flex gap-4">
        <select name="status" class="px-4 py-2 border border-neutral-300 rounded-lg" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="pending_payment" {{ request('status') == 'pending_payment' ? 'selected' : '' }}>Menunggu Pembayaran</option>
            <option value="payment_uploaded" {{ request('status') == 'payment_uploaded' ? 'selected' : '' }}>Pembayaran Diupload</option>
            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dikirim</option>
            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Selesai</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
    </form>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-neutral-200">
        <thead class="bg-neutral-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Nomor Pesanan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Pelanggan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Tanggal</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-neutral-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-neutral-200">
            @forelse($orders as $order)
                <tr>
                    <td class="px-6 py-4">
                        <div class="font-medium text-neutral-900">{{ $order->order_number }}</div>
                        @if($order->payment && $order->payment->paymentProof)
                            <span class="text-xs text-blue-600">📎 Bukti pembayaran tersedia</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($order->user_id)
                            <div class="text-sm font-medium">{{ $order->user->name }}</div>
                            <div class="text-sm text-neutral-500">{{ $order->user->email }}</div>
                        @else
                            <div class="text-sm font-medium">{{ $order->guest_name }}</div>
                            <div class="text-sm text-neutral-500">{{ $order->guest_email }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @if($order->status == 'pending_payment')
                            <span class="px-2 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Pembayaran</span>
                        @elseif($order->status == 'payment_uploaded')
                            <span class="px-2 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Perlu Verifikasi</span>
                        @elseif($order->status == 'processing')
                            <span class="px-2 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Diproses</span>
                        @elseif($order->status == 'shipped')
                            <span class="px-2 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Dikirim</span>
                        @elseif($order->status == 'delivered')
                            <span class="px-2 text-xs font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                        @else
                            <span class="px-2 text-xs font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-neutral-500">{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-primary-600 hover:text-primary-900">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-neutral-500">Belum ada pesanan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $orders->links() }}
</div>
@endsection
