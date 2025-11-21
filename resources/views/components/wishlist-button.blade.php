{{-- Wishlist Button Component --}}
@props(['productId'])

@auth
    @php
        $inWishlist = auth()->user()->hasInWishlist($productId);
    @endphp
    
    @if($inWishlist)
        <form action="{{ route('wishlist.destroy', $productId) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-md hover:bg-red-50 transition z-10"
                    title="Hapus dari Wishlist">
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
            </button>
        </form>
    @else
        <form action="{{ route('wishlist.store') }}" method="POST" class="inline">
            @csrf
            <input type="hidden" name="product_id" value="{{ $productId }}">
            <button type="submit" 
                    class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-md hover:bg-primary-50 transition z-10"
                    title="Tambah ke Wishlist">
                <svg class="w-5 h-5 text-neutral-400 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </button>
        </form>
    @endif
@else
    <a href="{{ route('login') }}" 
       class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-md hover:bg-primary-50 transition z-10"
       title="Login untuk menambahkan ke wishlist">
        <svg class="w-5 h-5 text-neutral-400 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
    </a>
@endauth
