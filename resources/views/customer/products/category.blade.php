@extends('layouts.app')

@section('title', $category->name . ' - JerukPin')

@section('content')
<div class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-heading font-bold mb-2">{{ $category->name }}</h1>
        <p class="text-primary-100">{{ $category->description }}</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($products as $product)
            <x-product-card :product="$product" />
        @empty
            <div class="col-span-3 text-center py-12 text-neutral-500">
                Belum ada produk dalam kategori ini.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection
