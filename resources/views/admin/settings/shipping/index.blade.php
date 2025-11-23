@extends('admin.layouts.app')

@section('title', 'Metode Pengiriman')
@section('page-title', 'Metode Pengiriman')
@section('page-description', 'Kelola metode pengiriman yang tersedia')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.shipping-methods.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-semibold transition shadow-md hover:shadow-lg inline-flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Tambah Metode Pengiriman
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-neutral-200">
    <table class="min-w-full">
        <thead class="bg-neutral-50">
            <tr>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Icon</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Kode</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Biaya</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Estimasi</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3.5 text-right text-xs font-semibold text-neutral-700 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-neutral-200">
            @forelse($shippingMethods as $method)
            <tr class="hover:bg-neutral-50 transition">
                <td class="px-6 py-4">
                    <div class="text-2xl">{{ $method->icon }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-neutral-900">{{ $method->name }}</div>
                    @if($method->description)
                        <div class="text-xs text-neutral-500 mt-0.5">{{ $method->description }}</div>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <code class="text-xs bg-neutral-100 px-2 py-1 rounded">{{ $method->code }}</code>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-neutral-900">{{ $method->formatted_cost }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-neutral-600">{{ $method->estimate_text }}</div>
                </td>
                <td class="px-6 py-4">
                    @if($method->is_active)
                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-neutral-100 text-neutral-500">
                            Nonaktif
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.shipping-methods.edit', $method) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Edit
                        </a>
                        <form action="{{ route('admin.shipping-methods.destroy', $method) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus metode pengiriman ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="mt-2 text-sm text-neutral-500">Belum ada metode pengiriman</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
