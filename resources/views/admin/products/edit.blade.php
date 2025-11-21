@extends('admin.layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-heading font-bold text-neutral-900 mb-6">Edit Produk: {{ $product->name }}</h1>

    <!-- Product Info -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Informasi Produk</h2>
        <form action="{{ route('admin.products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Kategori *</label>
                    <select name="category_id" required class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Nama Produk *</label>
                    <input type="text" name="name" value="{{ $product->name }}" required
                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-neutral-700 mb-2">Slug *</label>
                <input type="text" name="slug" value="{{ $product->slug }}" required
                    class="w-full px-4 py-2 border border-neutral-300 rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-neutral-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-neutral-300 rounded-lg">{{ $product->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}
                        class="rounded border-neutral-300 text-primary-600">
                    <span class="ml-2 text-sm">Aktifkan produk</span>
                </label>
            </div>

            <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-lg">
                Update Produk
            </button>
        </form>
    </div>

    <!-- Images -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Gambar Produk (Max 5)</h2>
        
        <div class="grid grid-cols-5 gap-4 mb-4">
            @foreach($product->images as $image)
                <div class="relative">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-32 object-cover rounded">
                    @if($image->is_primary)
                        <span class="absolute top-1 left-1 bg-primary-500 text-white text-xs px-2 py-1 rounded">Utama</span>
                    @endif
                    <div class="absolute bottom-1 right-1 flex space-x-1">
                        @if(!$image->is_primary)
                            <form action="{{ route('admin.products.images.primary', $image) }}" method="POST">
                                @csrf
                                <button class="bg-white text-xs px-2 py-1 rounded shadow">Set Utama</button>
                            </form>
                        @endif
                        <form action="{{ route('admin.products.images.delete', $image) }}" method="POST" onsubmit="return confirm('Hapus gambar?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @if($product->images->count() < 5)
            <form action="{{ route('admin.products.images.upload', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="images[]" multiple accept="image/*" class="mb-2">
                <button type="submit" class="bg-secondary-500 hover:bg-secondary-600 text-white px-4 py-2 rounded-lg text-sm">
                    Upload Gambar
                </button>
                <p class="text-xs text-neutral-500 mt-1">Max 5MB per gambar, format: JPG, PNG</p>
            </form>
        @else
            <p class="text-sm text-neutral-500">Maksimal 5 gambar tercapai</p>
        @endif
    </div>

    <!-- Variants -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-xl font-bold mb-4">Varian Produk</h2>
        
        <table class="w-full mb-4">
            <thead class="bg-neutral-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm">Nama</th>
                    <th class="px-4 py-2 text-left text-sm">SKU</th>
                    <th class="px-4 py-2 text-left text-sm">Harga</th>
                    <th class="px-4 py-2 text-left text-sm">Stok</th>
                    <th class="px-4 py-2 text-left text-sm">Terjual</th>
                    <th class="px-4 py-2 text-right text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->variants as $variant)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $variant->variant_name }}</td>
                        <td class="px-4 py-2 text-sm text-neutral-600">{{ $variant->sku }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($variant->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $variant->stock }}</td>
                        <td class="px-4 py-2 text-sm text-neutral-600">{{ $variant->sold_count }}</td>
                        <td class="px-4 py-2 text-right">
                            <form action="{{ route('admin.products.variants.delete', $variant) }}" method="POST" class="inline" onsubmit="return confirm('Hapus varian?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <details class="border-t pt-4">
            <summary class="cursor-pointer text-primary-600 font-medium">+ Tambah Varian Baru</summary>
            <form action="{{ route('admin.products.variants.add', $product) }}" method="POST" class="mt-4 grid grid-cols-4 gap-4">
                @csrf
                <input type="text" name="variant_name" placeholder="Nama Varian" required class="px-4 py-2 border rounded-lg">
                <input type="text" name="sku" placeholder="SKU" required class="px-4 py-2 border rounded-lg">
                <input type="number" name="price" placeholder="Harga" required class="px-4 py-2 border rounded-lg">
                <input type="number" name="stock" placeholder="Stok" required class="px-4 py-2 border rounded-lg">
                <button type="submit" class="col-span-4 bg-primary-500 text-white px-4 py-2 rounded-lg">Tambah Varian</button>
            </form>
        </details>
    </div>
</div>
@endsection
