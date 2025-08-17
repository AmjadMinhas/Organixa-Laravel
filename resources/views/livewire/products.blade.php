<div>
    <!-- Filters -->
    <div class="mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <label for="search" class="sr-only">Search products</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-green-500 focus:border-green-500" placeholder="Search products...">
                </div>
            </div>

            <!-- Category Filter -->
            <div>
                <label for="category" class="sr-only">Category</label>
                <select wire:model.live="category" id="category" class="block w-full px-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sort -->
            <div>
                <label for="sort" class="sr-only">Sort by</label>
                <select wire:model.live="sortBy" id="sort" class="block w-full px-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    <option value="latest">Latest</option>
                    <option value="price_low">Price: Low to High</option>
                    <option value="price_high">Price: High to Low</option>
                    <option value="name">Name: A to Z</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    <div class="mb-6">
        <p class="text-sm text-gray-600">
            Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
        </p>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="group relative bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-200">
                    <!-- Product Image -->
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-t-lg bg-gray-200">
                        <img src="{{ $product->first_image }}" alt="{{ $product->title }}" class="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300">
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">
                            <a href="{{ route('product.detail', $product) }}" class="hover:text-green-600">
                                {{ $product->title }}
                            </a>
                        </h3>
                        
                        <p class="text-sm text-gray-500 mb-3 line-clamp-2">
                            {{ Str::limit($product->description, 80) }}
                        </p>

                        <!-- Price and Stock -->
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-lg font-semibold text-gray-900">₨{{ number_format($product->price) }}</p>
                            @if($product->isInStock())
                                <span class="text-sm text-green-600">In Stock</span>
                            @else
                                <span class="text-sm text-red-600">Out of Stock</span>
                            @endif
                        </div>

                        <!-- Add to Cart Button -->
                        <button 
                            wire:click="addToCart({{ $product->id }})"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            @if(!$product->isInStock()) disabled @endif
                            class="w-full bg-green-600 hover:bg-green-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center"
                        >
                            <svg wire:loading wire:target="addToCart({{ $product->id }})" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <svg wire:loading.remove wire:target="addToCart({{ $product->id }})" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                            </svg>
                            {{ $product->isInStock() ? 'Add to Cart' : 'Out of Stock' }}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
            <p class="mt-1 text-sm text-gray-500">
                Try adjusting your search or filter criteria.
            </p>
        </div>
    @endif

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ session('error') }}
        </div>
    @endif

    <!-- Livewire Flash Messages -->
    <div wire:ignore>
        <div id="livewire-success" class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 hidden">
            <span id="success-message"></span>
        </div>
        <div id="livewire-error" class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 hidden">
            <span id="error-message"></span>
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
                }, 3000);
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
