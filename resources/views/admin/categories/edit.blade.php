@extends('admin.layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-3xl font-heading font-bold text-neutral-900 mb-6">Edit Kategori</h1>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-neutral-700 mb-2">Nama Kategori *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                    class="w-full px-4 py-2 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-neutral-700 mb-2">Slug *</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" required
                    class="w-full px-4 py-2 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-neutral-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-4 py-2 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-neutral-700 mb-2">Gambar Kategori</label>
                @if($category->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="h-20 w-20 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full px-4 py-2 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <p class="mt-1 text-sm text-neutral-500">Format: JPG, PNG, GIF (Max. 2MB). Biarkan kosong jika tidak ingin mengubah gambar.</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                        class="rounded border-neutral-300 text-primary-600 focus:ring-primary-500">
                    <span class="ml-2 text-sm text-neutral-700">Aktifkan kategori</span>
                </label>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-2 border border-neutral-300 rounded-lg text-neutral-700 hover:bg-neutral-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-lg font-medium">
                    Update Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
