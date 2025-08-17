@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Product Images -->
        <div class="space-y-4">
            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200">
                <img src="{{ $product->first_image }}" alt="{{ $product->title }}" class="h-full w-full object-cover object-center">
            </div>
            
            @if($product->images && count($product->images) > 1)
                <div class="grid grid-cols-4 gap-2">
                    @foreach($product->images as $image)
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200">
                            <img src="{{ $image }}" alt="{{ $product->title }}" class="h-full w-full object-cover object-center cursor-pointer hover:opacity-75">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="space-y-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $product->title }}</h1>
                <p class="mt-2 text-sm text-gray-500">Category: {{ $product->category }}</p>
            </div>

            <div class="flex items-center space-x-4">
                <p class="text-3xl font-bold text-gray-900">₨{{ number_format($product->price) }}</p>
                @if($product->isInStock())
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        In Stock
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Out of Stock
                    </span>
                @endif
            </div>

            <div class="prose prose-sm text-gray-500">
                <p>{{ $product->description }}</p>
            </div>

            @if($product->isInStock())
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <label for="quantity" class="text-sm font-medium text-gray-700">Quantity:</label>
                        <div class="flex items-center space-x-2">
                            <button 
                                id="decrease-quantity"
                                class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-50"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <input 
                                type="number" 
                                id="quantity" 
                                value="1" 
                                min="1" 
                                max="99"
                                class="w-16 text-center border border-gray-300 rounded-md py-1 text-sm"
                            >
                            <button 
                                id="increase-quantity"
                                class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-50"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button 
                        id="add-to-cart"
                        data-product-id="{{ $product->id }}"
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Add to Cart
                    </button>
                </div>
            @endif

            <!-- Product Details -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Product Details</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">SKU</dt>
                        <dd class="text-sm text-gray-900">{{ $product->sku ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">Category</dt>
                        <dd class="text-sm text-gray-900">{{ $product->category }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">Stock</dt>
                        <dd class="text-sm text-gray-900">{{ $product->stock ?? 'N/A' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($product->getRelatedProducts() as $relatedProduct)
                <div class="group relative bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-200">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-t-lg bg-gray-200">
                        <img src="{{ $relatedProduct->first_image }}" alt="{{ $relatedProduct->title }}" class="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300">
                    </div>
                    <div class="p-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">
                            <a href="{{ route('product.detail', $relatedProduct) }}" class="hover:text-green-600">
                                {{ $relatedProduct->title }}
                            </a>
                        </h3>
                        <p class="text-lg font-semibold text-gray-900">₨{{ number_format($relatedProduct->price) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Success/Error Messages -->
<div id="message-container" class="fixed bottom-4 right-4 z-50 hidden">
    <div id="message" class="px-6 py-3 rounded-lg shadow-lg text-white"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantity');
    const decreaseBtn = document.getElementById('decrease-quantity');
    const increaseBtn = document.getElementById('increase-quantity');
    const addToCartBtn = document.getElementById('add-to-cart');
    const messageContainer = document.getElementById('message-container');
    const message = document.getElementById('message');

    // Quantity controls
    decreaseBtn.addEventListener('click', function() {
        const currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    increaseBtn.addEventListener('click', function() {
        const currentValue = parseInt(quantityInput.value);
        if (currentValue < 99) {
            quantityInput.value = currentValue + 1;
        }
    });

    // Add to cart functionality
    addToCartBtn.addEventListener('click', function() {
        const productId = this.dataset.productId;
        const quantity = parseInt(quantityInput.value);

        fetch('/api/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            showMessage(data.message || 'Product added to cart!', 'success');
            // Update cart count in header if it exists
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) {
                const currentCount = parseInt(cartCount.textContent) || 0;
                cartCount.textContent = currentCount + quantity;
            }
        })
        .catch(error => {
            showMessage('Error adding product to cart', 'error');
        });
    });

    function showMessage(text, type) {
        message.textContent = text;
        message.className = `px-6 py-3 rounded-lg shadow-lg text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
        messageContainer.classList.remove('hidden');
        
        setTimeout(() => {
            messageContainer.classList.add('hidden');
        }, 3000);
    }
});
</script>
@endsection 