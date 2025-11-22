```
        @if ($products->count())
            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-32 h-32 bg-gradient-to-br from-orange-100 to-orange-200 rounded-full mb-6">
                    <span class="text-6xl">🍊</span>
                </div>
                <h3 class="text-2xl font-bold text-neutral-900 mb-3">Belum Ada Produk</h3>
                <p class="text-neutral-600 mb-8 max-w-md mx-auto">
                    Saat ini belum ada produk dalam kategori ini. Silakan cek kategori lain atau kembali lagi nanti!
                </p>
                <a href="{{ route('products.index') }}" class="inline-block bg-gradient-to-r from-orange-500 to-orange-600 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-xl transition-all transform hover:scale-105">
                    Lihat Semua Produk
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
```
