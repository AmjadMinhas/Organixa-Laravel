<div>
    <div class="product-grid">
        @foreach($featuredProducts as $product)
        <div class="product-card group">
            <div class="relative overflow-hidden">
                <img src="{{ $product->getFirstImageAttribute() }}" alt="{{ $product->title }}" class="product-image">
                @if($product->stock <= 10 && $product->stock > 0)
                    <div class="absolute top-4 right-4 bg-accent text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg">
                        Low Stock
                    </div>
                @endif
                @if($product->stock == 0)
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg">
                        Out of Stock
                    </div>
                @endif
            </div>
            <div class="product-info">
                <span class="product-category">{{ $product->category }}</span>
                <h3 class="product-title">{{ $product->title }}</h3>
                <p class="product-benefits">{{ Str::limit($product->benefits, 80) }}</p>
                <div class="product-price">PKR{{ number_format($product->price, 2) }}</div>
                <div class="flex gap-3">
                    <a href="{{ route('product.detail', $product->id) }}" class="btn-outline flex-1 text-center">
                        View Details
                    </a>
                    @if($product->isInStock())
                        <button 
                            wire:click="addToCart({{ $product->id }})"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="btn-primary flex-1"
                        >
                            <svg wire:loading wire:target="addToCart({{ $product->id }})" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <svg wire:loading.remove wire:target="addToCart({{ $product->id }})" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Add to Cart
                        </button>
                    @else
                        <button disabled class="btn-secondary flex-1 opacity-50 cursor-not-allowed">
                            Out of Stock
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div class="fixed bottom-6 right-6 bg-green-500 text-white px-6 py-4 rounded-xl shadow-2xl z-50 max-w-sm" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="fixed bottom-6 right-6 bg-red-500 text-white px-6 py-4 rounded-xl shadow-2xl z-50 max-w-sm" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif
</div>
