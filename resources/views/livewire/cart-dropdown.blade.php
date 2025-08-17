<div class="ml-3 relative" x-data="{ open: false }">
    <button @click="open = !open" class="relative p-2 text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
        </svg>
        @if($cartCount > 0)
            <span class="absolute -top-1 -right-1 h-5 w-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center cart-count">
                {{ $cartCount }}
            </span>
        @endif
    </button>
    
    <!-- Cart Dropdown Menu -->
    <div 
        x-show="open" 
        @click.away="open = false" 
        x-transition:enter="transition ease-out duration-100" 
        x-transition:enter-start="transform opacity-0 scale-95" 
        x-transition:enter-end="transform opacity-100 scale-100" 
        x-transition:leave="transition ease-in duration-75" 
        x-transition:leave-start="transform opacity-100 scale-100" 
        x-transition:leave-end="transform opacity-0 scale-95" 
        class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-50"
        style="display: none;"
    >
        @if($cartItems->count() > 0)
            <div class="px-4 py-3 border-b border-gray-200">
                <h3 class="text-sm font-medium text-gray-900">Shopping Cart</h3>
            </div>
            
            <div class="max-h-64 overflow-y-auto">
                @foreach($cartItems as $item)
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <img src="{{ $item->product->first_image }}" alt="{{ $item->product->title }}" class="w-10 h-10 object-cover rounded">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $item->product->title }}</p>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                <p class="text-sm font-medium text-gray-900">₨{{ number_format($item->subtotal) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                @php
                    $totalItems = auth()->check() ? auth()->user()->cartItems->count() : count(session('cart', []));
                @endphp
                @if($totalItems > 3)
                    <div class="px-4 py-2 text-sm text-gray-500">
                        +{{ $totalItems - 3 }} more items
                    </div>
                @endif
            </div>
            
            <div class="px-4 py-3 border-t border-gray-200">
                <div class="flex justify-between text-sm font-medium text-gray-900 mb-3">
                    <span>Total:</span>
                    <span>₨{{ number_format($cartTotal) }}</span>
                </div>
                <a href="{{ route('cart') }}" @click="open = false" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                    View Cart
                </a>
            </div>
        @else
            <div class="px-4 py-6 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <p class="mt-2 text-sm text-gray-500">Your cart is empty</p>
                <a href="{{ route('products') }}" @click="open = false" class="mt-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('livewire:init', () => {
    // Listen for cart updates from Livewire
    Livewire.on('cart-updated', () => {
        // Force refresh the cart dropdown component
        @this.$refresh();
        
        // Show success message
        showSuccessMessage('Product added to cart successfully!');
    });
    
    // Listen for cart count updates
    Livewire.on('cart-count-updated', (event) => {
        // Update cart count with the actual count from server
        const cartCountElement = document.querySelector('.cart-count');
        if (cartCountElement) {
            cartCountElement.textContent = event.count;
        }
        
        // Force refresh this component
        @this.$refresh();
    });
});

function updateCartCount() {
    // Get current cart count
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        const currentCount = parseInt(cartCountElement.textContent) || 0;
        cartCountElement.textContent = currentCount + 1;
    }
}

function showSuccessMessage(message) {
    // Create or update success message
    let messageDiv = document.getElementById('cart-success-message');
    if (!messageDiv) {
        messageDiv = document.createElement('div');
        messageDiv.id = 'cart-success-message';
        messageDiv.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
        document.body.appendChild(messageDiv);
    }
    
    messageDiv.textContent = message;
    messageDiv.style.display = 'block';
    
    setTimeout(() => {
        messageDiv.style.display = 'none';
    }, 3000);
}
</script> 