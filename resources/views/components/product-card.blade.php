            @if($product->variants->first())
                <p class="text-lg font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Mulai Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}</p>
            @endif
            <div class="flex items-center justify-between mt-2">
                <p class="text-xs text-neutral-500">📦 Terjual {{ $product->total_sold_count }}</p>
                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </a>
</div>
