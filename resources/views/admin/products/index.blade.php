@extends('admin.layouts.app')

@section('title', 'Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-heading font-bold text-neutral-900">Produk</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-lg font-medium">
        + Tambah Produk
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-neutral-200">
        <thead class="bg-neutral-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Produk</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Kategori</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Varian</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Terjual</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-neutral-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-neutral-200">
            @forelse($products as $product)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($product->images->first())
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded object-cover mr-3">
                            @else
                                <div class="w-12 h-12 bg-neutral-200 rounded mr-3 flex items-center justify-center text-neutral-400">📦</div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-neutral-900">{{ $product->name }}</div>
                                @if($product->isBestSeller())
                                    <span class="text-xs bg-primary-100 text-primary-800 px-2 py-0.5 rounded">⭐ Best Seller</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-neutral-500">{{ $product->category->name }}</td>
                    <td class="px-6 py-4 text-sm text-neutral-500">{{ $product->variants_count }} varian</td>
                    <td class="px-6 py-4 text-sm text-neutral-500">{{ $product->total_sold_count }}</td>
                    <td class="px-6 py-4">
                        @if($product->is_active)
                            <span class="px-2 text-xs font-semibold rounded-full bg-secondary-100 text-secondary-800">Aktif</span>
                        @else
                            <span class="px-2 text-xs font-semibold rounded-full bg-neutral-100 text-neutral-800">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-primary-600 hover:text-primary-900">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-neutral-500">
                        Belum ada produk. <a href="{{ route('admin.products.create') }}" class="text-primary-600">Tambah produk pertama</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>
@endsection
