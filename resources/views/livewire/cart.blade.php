<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
        <p class="mt-2 text-gray-600">Review your items and proceed to checkout</p>
    </div>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Cart Items ({{ $cartItems->count() }})</h2>
                        
                        <div class="space-y-4">
                            @foreach($cartItems as $item)
                                <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        <img src="{{ $item->product->first_image }}" alt="{{ $item->product->title }}" class="w-16 h-16 object-cover rounded-md">
                                    </div>
                                    
                                    <!-- Product Details -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-medium text-gray-900 truncate">
                                            <a href="{{ route('product.detail', $item->product) }}" class="hover:text-green-600">
                                                {{ $item->product->title }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-500">{{ Str::limit($item->product->description, 60) }}</p>
                                        <p class="text-sm font-medium text-gray-900 mt-1">₨{{ number_format($item->product->price) }}</p>
                                    </div>
                                    
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center space-x-2">
                                        <button 
                                            wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                            @if($item->quantity <= 1) disabled @endif
                                            class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        
                                        <span class="w-12 text-center text-sm font-medium text-gray-900">{{ $item->quantity }}</span>
                                        
                                        <button 
                                            wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                            class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-50"
                                        >
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <!-- Subtotal -->
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">₨{{ number_format($item->subtotal) }}</p>
                                    </div>
                                    
                                    <!-- Remove Button -->
                                    <button 
                                        wire:click="removeFromCart({{ $item->id }})"
                                        class="text-red-500 hover:text-red-700 p-1"
                                        title="Remove item"
                                    >
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Clear Cart Button -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <button 
                                wire:click="clearCart"
                                class="text-red-600 hover:text-red-800 text-sm font-medium"
                            >
                                Clear Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="text-gray-900">₨{{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="text-gray-900">₨0</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tax</span>
                            <span class="text-gray-900">₨0</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between text-base font-semibold">
                                <span class="text-gray-900">Total</span>
                                <span class="text-gray-900">₨{{ number_format($total) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a 
                            href="{{ route('checkout') }}"
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Proceed to Checkout
                        </a>
                    </div>
                    
                    <div class="mt-4">
                        <a 
                            href="{{ route('products') }}"
                            class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center"
                        >
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Your cart is empty</h3>
            <p class="mt-1 text-sm text-gray-500">
                Start shopping to add items to your cart.
            </p>
            <div class="mt-6">
                <a 
                    href="{{ route('products') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700"
                >
                    Browse Products
                </a>
            </div>
        </div>
    @endif
</div>
