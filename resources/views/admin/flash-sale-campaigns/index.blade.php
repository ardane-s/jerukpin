@extends('admin.layouts.app')

@section('title', 'Flash Sale Campaigns')
@section('page-title', 'Flash Sale Campaigns')
@section('page-description', 'Kelola campaign flash sale dengan sistem queue otomatis')

@section('content')
<div class="flex justify-end items-center mb-6">
    <a href="{{ route('admin.flash-sale-campaigns.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-5 py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Buat Campaign Baru
    </a>
</div>

<!-- Active Campaign -->
@if($activeCampaign)
<div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-6 mb-6">
    <div class="flex items-start justify-between">
        <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-600 text-white animate-pulse">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    AKTIF SEKARANG
                </span>
                <h2 class="text-2xl font-bold text-green-900">{{ $activeCampaign->name }}</h2>
            </div>
            @if($activeCampaign->description)
                <p class="text-green-700 mb-3">{{ $activeCampaign->description }}</p>
            @endif
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                <div class="bg-white rounded-lg p-3 border border-green-200">
                    <p class="text-xs text-neutral-600 mb-1">Total Produk</p>
                    <p class="text-xl font-bold text-neutral-900">{{ $activeCampaign->total_products }}</p>
                </div>
                <div class="bg-white rounded-lg p-3 border border-green-200">
                    <p class="text-xs text-neutral-600 mb-1">Terjual</p>
                    <p class="text-xl font-bold text-green-600">{{ $activeCampaign->total_sold }}</p>
                </div>
                <div class="bg-white rounded-lg p-3 border border-green-200">
                    <p class="text-xs text-neutral-600 mb-1">Revenue</p>
                    <p class="text-xl font-bold text-green-600">Rp {{ number_format($activeCampaign->total_revenue, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white rounded-lg p-3 border border-green-200">
                    <p class="text-xs text-neutral-600 mb-1">Berakhir</p>
                    <p class="text-sm font-bold text-neutral-900">{{ $activeCampaign->end_time->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="ml-4">
            <a href="{{ route('admin.flash-sale-campaigns.products', $activeCampaign) }}" class="text-green-700 hover:text-green-900 font-medium text-sm">
                Kelola Produk →
            </a>
        </div>
    </div>
</div>
@endif

<!-- Upcoming Queue -->
@if($upcomingCampaigns->count() > 0)
<div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6 mb-6">
    <h3 class="text-lg font-bold text-neutral-900 mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        Campaign Queue ({{ $upcomingCampaigns->count() }})
    </h3>
    <div class="space-y-3">
        @foreach($upcomingCampaigns as $index => $campaign)
            <div class="flex items-center gap-4 p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                <div class="flex-shrink-0 w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">
                    {{ $index + 1 }}
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <h4 class="font-bold text-neutral-900">{{ $campaign->name }}</h4>
                        @if($campaign->show_teaser)
                            <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full font-medium">Teaser ON</span>
                        @endif
                    </div>
                    <p class="text-sm text-neutral-600">
                        Mulai: {{ $campaign->start_time->format('d M Y, H:i') }} 
                        <span class="text-neutral-400">•</span>
                        Berakhir: {{ $campaign->end_time->format('d M Y, H:i') }}
                    </p>
                    <p class="text-xs text-blue-700 mt-1">{{ $campaign->total_products }} produk</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.flash-sale-campaigns.products', $campaign) }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                        Kelola
                    </a>
                    <a href="{{ route('admin.flash-sale-campaigns.edit', $campaign) }}" class="text-orange-600 hover:text-orange-700 font-medium text-sm">
                        Edit
                    </a>
                    <form action="{{ route('admin.flash-sale-campaigns.destroy', $campaign) }}" method="POST" class="inline" onsubmit="return confirm('Hapus campaign ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-700 font-medium text-sm">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

<!-- Ended Campaigns -->
<div class="bg-white rounded-xl shadow-sm border border-neutral-200">
    <div class="px-6 py-4 border-b border-neutral-200">
        <h3 class="text-lg font-bold text-neutral-900">Riwayat Campaign</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-neutral-200">
            <thead class="bg-neutral-50">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Campaign</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Periode</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Terjual</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Revenue</th>
                    <th class="px-6 py-3.5 text-right text-xs font-semibold text-neutral-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200">
                @forelse($endedCampaigns as $campaign)
                    <tr class="hover:bg-neutral-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-neutral-900">{{ $campaign->name }}</div>
                            @if($campaign->description)
                                <div class="text-sm text-neutral-500 mt-1">{{ Str::limit($campaign->description, 50) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-neutral-600">
                            <div>{{ $campaign->start_time->format('d M Y') }}</div>
                            <div class="text-xs text-neutral-500">{{ $campaign->end_time->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-neutral-700">{{ $campaign->total_products }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-green-600">{{ $campaign->total_sold }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-green-600">Rp {{ number_format($campaign->total_revenue, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.flash-sale-campaigns.destroy', $campaign) }}" method="POST" class="inline" onsubmit="return confirm('Hapus campaign dari riwayat?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 font-medium text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <p class="mt-2 text-sm text-neutral-500">Belum ada campaign yang berakhir</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $endedCampaigns->links() }}
</div>
@endsection
