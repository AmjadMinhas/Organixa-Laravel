<div class="ml-3 relative">
    <button wire:click="$toggle('open')" class="relative p-2 text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
        </svg>
        <span class="absolute -top-1 -right-1 h-5 w-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center cart-count" style="display: {{ $cartCount > 0 ? 'flex' : 'none' }};">
            {{ $cartCount }}
        </span>
    </button>
    
    <!-- Cart Dropdown Menu -->
    @if($open)
    <div class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-50" wire:ignore.self>
        @if($cartItems->count() > 0)
            <div class="px-4 py-3 border-b border-gray-200">
                <h3 class="text-sm font-medium text-gray-900">Shopping Cart</h3>
            </div>
            
            <div class="max-h-64 overflow-y-auto">
                @foreach($cartItems as $item)
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <img src="{{ $item->product->getFirstImageAttribute() }}" alt="{{ $item->product->title }}" class="w-10 h-10 object-cover rounded">
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
                <a href="{{ route('cart') }}" wire:click="$set('open', false)" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                    View Cart
                </a>
            </div>
        @else
            <div class="px-4 py-6 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <p class="mt-2 text-sm text-gray-500">Your cart is empty</p>
                <a href="{{ route('products') }}" wire:click="$set('open', false)" class="mt-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
    @endif
</div>

<script>
document.addEventListener('livewire:init', () => {
    // Listen for cart updates from Livewire
    Livewire.on('cart-updated', () => {
        // Force refresh the cart dropdown component
        @this.$refresh();
    });
});

// Add click outside handler to close cart dropdown
document.addEventListener('click', function(event) {
    // Find all cart dropdown components
    const cartDropdowns = document.querySelectorAll('[wire\\:id*="cart-dropdown"]');
    
    cartDropdowns.forEach(cartDropdown => {
        if (cartDropdown && !cartDropdown.contains(event.target)) {
            // Click was outside this cart dropdown, close it
            if (window.Livewire) {
                const component = cartDropdown.__livewire;
                if (component && component.get('open')) {
                    component.set('open', false);
                }
            }
        }
    });
});

// Also close dropdown when pressing Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const cartDropdowns = document.querySelectorAll('[wire\\:id*="cart-dropdown"]');
        cartDropdowns.forEach(cartDropdown => {
            if (window.Livewire) {
                const component = cartDropdown.__livewire;
                if (component && component.get('open')) {
                    component.set('open', false);
                }
            }
        });
    }
});
</script> 