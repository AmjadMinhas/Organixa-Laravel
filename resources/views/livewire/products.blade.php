<div>
    <!-- Filters -->
    <div class="mb-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Search -->
            <div class="md:col-span-2">
                <label for="search" class="sr-only">Search products</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" id="search" class="form-input pl-12" placeholder="Search products...">
                </div>
            </div>

            <!-- Category Filter -->
            <div>
                <label for="category" class="sr-only">Category</label>
                <select wire:model.live="category" id="category" class="form-input">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sort -->
            <div>
                <label for="sort" class="sr-only">Sort by</label>
                <select wire:model.live="sortBy" id="sort" class="form-input">
                    <option value="latest">Latest</option>
                    <option value="price_low">Price: Low to High</option>
                    <option value="price_high">Price: High to Low</option>
                    <option value="name">Name: A to Z</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    <div class="mb-8">
        <p class="text-sm text-text-light font-medium">
            Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
        </p>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card group">
                    <!-- Product Image -->
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

                    <!-- Product Info -->
                    <div class="product-info">
                        <h3 class="product-title">
                            <a href="{{ route('product.detail', $product) }}" class="hover:text-primary transition-colors duration-300">
                                {{ $product->title }}
                            </a>
                        </h3>
                        
                        <p class="product-benefits">
                            {{ Str::limit($product->description, 80) }}
                        </p>

                        <!-- Price and Stock -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="product-price">₨{{ number_format($product->price) }}</div>
                            @if($product->isInStock())
                                <span class="text-sm text-accent font-medium">In Stock</span>
                            @else
                                <span class="text-sm text-red-500 font-medium">Out of Stock</span>
                            @endif
                        </div>

                        <!-- Add to Cart Button -->
                        <button 
                            wire:click="addToCart({{ $product->id }})"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            @if(!$product->isInStock()) disabled @endif
                            class="w-full btn-primary flex items-center justify-center"
                        >
                            <svg wire:loading wire:target="addToCart({{ $product->id }})" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <svg wire:loading.remove wire:target="addToCart({{ $product->id }})" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            {{ $product->isInStock() ? 'Add to Cart' : 'Out of Stock' }}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gradient-to-br from-accent to-accent-light rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
                </svg>
            </div>
            <h3 class="text-xl font-serif font-semibold text-text mb-2">No products found</h3>
            <p class="text-text-light max-w-md mx-auto">
                Try adjusting your search or filter criteria to find what you're looking for.
            </p>
        </div>
    @endif

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div class="fixed bottom-6 right-6 bg-accent text-white px-6 py-4 rounded-xl shadow-2xl z-50 max-w-sm" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
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

    <!-- Livewire Flash Messages -->
    <div wire:ignore>
        <div id="livewire-success" class="fixed bottom-6 right-6 bg-accent text-white px-6 py-4 rounded-xl shadow-2xl z-50 max-w-sm hidden">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span id="success-message" class="font-medium"></span>
            </div>
        </div>
        <div id="livewire-error" class="fixed bottom-6 right-6 bg-red-500 text-white px-6 py-4 rounded-xl shadow-2xl z-50 max-w-sm hidden">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span id="error-message" class="font-medium"></span>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('cart-updated', () => {
                // Show success message
                const successDiv = document.getElementById('livewire-success');
                const successMessage = document.getElementById('success-message');
                successMessage.textContent = 'Product added to cart successfully!';
                successDiv.classList.remove('hidden');
                
                setTimeout(() => {
                    successDiv.classList.add('hidden');
                }, 4000);
            });
            
            Livewire.on('cart-count-updated', (event) => {
                // Update cart count with the actual count from server
                const cartCountElement = document.querySelector('.cart-count');
                if (cartCountElement) {
                    cartCountElement.textContent = event.count;
                }
                
                // Force refresh the cart dropdown component
                const cartDropdown = document.querySelector('[wire\\:id*="cart-dropdown"]');
                if (cartDropdown && cartDropdown.__livewire) {
                    cartDropdown.__livewire.$refresh();
                }
            });
        });
    </script>
</div>
