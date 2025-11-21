@extends('admin.layouts.app')

@section('title', 'Flash Sale')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-heading font-bold text-neutral-900">Flash Sale</h1>
    <a href="{{ route('admin.flash-sales.create') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-lg font-medium">
        + Buat Flash Sale
    </a>
</div>

<!-- Tabs -->
<div class="mb-6">
    <div class="border-b border-neutral-200">
        <nav class="-mb-px flex space-x-8">
            <button onclick="switchTab('active')" id="tab-active" class="tab-button border-b-2 border-primary-500 py-4 px-1 text-sm font-medium text-primary-600">
                Aktif & Akan Datang
                <span class="ml-2 bg-primary-100 text-primary-600 py-0.5 px-2.5 rounded-full text-xs font-semibold">{{ $activeFlashSales->total() }}</span>
            </button>
            <button onclick="switchTab('history')" id="tab-history" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-neutral-500 hover:text-neutral-700 hover:border-neutral-300">
                Riwayat (Berakhir)
                <span class="ml-2 bg-neutral-100 text-neutral-600 py-0.5 px-2.5 rounded-full text-xs font-semibold">{{ $endedFlashSales->total() }}</span>
            </button>
        </nav>
    </div>
</div>

<!-- Active Flash Sales Tab -->
<div id="content-active" class="tab-content">
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-neutral-200">
            <thead class="bg-neutral-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Periode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-neutral-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200">
                @forelse($activeFlashSales as $sale)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-neutral-900">{{ $sale->productVariant->product->name }}</div>
                            <div class="text-sm text-neutral-500">{{ $sale->productVariant->variant_name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm">
                                <span class="line-through text-neutral-400">Rp {{ number_format($sale->original_price, 0, ',', '.') }}</span>
                                <span class="text-primary-600 font-bold ml-2">Rp {{ number_format($sale->flash_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="text-xs text-secondary-600">Diskon {{ $sale->discount_percentage }}%</div>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            {{ $sale->flash_sold }} / {{ $sale->flash_stock }}
                            <div class="w-full bg-neutral-200 rounded-full h-1.5 mt-1">
                                <div class="bg-orange-500 h-1.5 rounded-full" style="width: {{ ($sale->flash_sold / $sale->flash_stock) * 100 }}%"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-neutral-500">
                            <div>Mulai: {{ $sale->start_time->format('d M Y, H:i') }}</div>
                            <div>Selesai: {{ $sale->end_time->format('d M Y, H:i') }}</div>
                            @if($sale->isActive())
                                <div class="mt-2 flex gap-1 text-xs countdown-timer" data-end-time="{{ $sale->end_time }}">
                                    <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded font-mono countdown-hours">00</span>:
                                    <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded font-mono countdown-minutes">00</span>:
                                    <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded font-mono countdown-seconds">00</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($sale->isActive())
                                <span class="px-2 text-xs font-semibold rounded-full bg-secondary-100 text-secondary-800">🔥 Aktif</span>
                            @elseif($sale->start_time > now())
                                <span class="px-2 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">⏰ Akan Datang</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm space-x-2">
                            <a href="{{ route('admin.flash-sales.edit', $sale) }}" class="text-primary-600 hover:text-primary-800">Edit</a>
                            @if($sale->is_active)
                                <form action="{{ route('admin.flash-sales.deactivate', $sale) }}" method="POST" class="inline">
                                    @csrf
                                    <button class="text-orange-600 hover:text-orange-800">Nonaktifkan</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.flash-sales.destroy', $sale) }}" method="POST" class="inline" onsubmit="return confirm('Hapus flash sale?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-neutral-500">
                            Belum ada flash sale aktif. <a href="{{ route('admin.flash-sales.create') }}" class="text-primary-600 hover:text-primary-800">Buat flash sale pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $activeFlashSales->links() }}
    </div>
</div>

<!-- History Tab -->
<div id="content-history" class="tab-content hidden">
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-neutral-200">
            <thead class="bg-neutral-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Terjual</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Periode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-neutral-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200">
                @forelse($endedFlashSales as $sale)
                    <tr class="bg-neutral-50 opacity-75">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-neutral-700">{{ $sale->productVariant->product->name }}</div>
                            <div class="text-sm text-neutral-500">{{ $sale->productVariant->variant_name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm">
                                <span class="line-through text-neutral-400">Rp {{ number_format($sale->original_price, 0, ',', '.') }}</span>
                                <span class="text-neutral-600 font-bold ml-2">Rp {{ number_format($sale->flash_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="text-xs text-neutral-500">Diskon {{ $sale->discount_percentage }}%</div>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="font-semibold text-neutral-700">{{ $sale->flash_sold }} / {{ $sale->flash_stock }}</div>
                            <div class="text-xs text-neutral-500">
                                {{ $sale->flash_sold > 0 ? round(($sale->flash_sold / $sale->flash_stock) * 100) : 0 }}% terjual
                            </div>
                            <div class="w-full bg-neutral-200 rounded-full h-1.5 mt-1">
                                <div class="bg-neutral-400 h-1.5 rounded-full" style="width: {{ ($sale->flash_sold / $sale->flash_stock) * 100 }}%"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-neutral-500">
                            <div>Mulai: {{ $sale->start_time->format('d M Y, H:i') }}</div>
                            <div>Selesai: {{ $sale->end_time->format('d M Y, H:i') }}</div>
                            <div class="text-xs text-neutral-400 mt-1">{{ $sale->end_time->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 text-xs font-semibold rounded-full bg-neutral-200 text-neutral-600">✓ Berakhir</span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm space-x-2">
                            <form action="{{ route('admin.flash-sales.destroy', $sale) }}" method="POST" class="inline" onsubmit="return confirm('Hapus flash sale dari riwayat?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-neutral-500">
                            Belum ada riwayat flash sale yang berakhir.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $endedFlashSales->links() }}
    </div>
</div>

<script>
// Tab Switching
function switchTab(tab) {
    // Hide all content
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active state from all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-primary-500', 'text-primary-600');
        button.classList.add('border-transparent', 'text-neutral-500');
    });
    
    // Show selected content
    document.getElementById('content-' + tab).classList.remove('hidden');
    
    // Activate selected tab
    const activeTab = document.getElementById('tab-' + tab);
    activeTab.classList.remove('border-transparent', 'text-neutral-500');
    activeTab.classList.add('border-primary-500', 'text-primary-600');
}

// Countdown Timers for Active Flash Sales
document.addEventListener('DOMContentLoaded', function() {
    const countdownEls = document.querySelectorAll('.countdown-timer');
    
    countdownEls.forEach(function(countdownEl) {
        const endTime = new Date(countdownEl.dataset.endTime).getTime();
        
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = endTime - now;
            
            if (distance < 0) {
                // Reload page when flash sale ends to move it to history
                location.reload();
                return;
            }
            
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            countdownEl.querySelector('.countdown-hours').textContent = String(hours).padStart(2, '0');
            countdownEl.querySelector('.countdown-minutes').textContent = String(minutes).padStart(2, '0');
            countdownEl.querySelector('.countdown-seconds').textContent = String(seconds).padStart(2, '0');
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
});
</script>
@endsection
