@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-green-50 to-emerald-100 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="font-playfair text-4xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Your Space to 
                    <span class="text-green-600">Plan + Glow</span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Discover the power of nature with our premium organic skincare collection. 
                    Crafted with natural ingredients for your skin's health and radiance.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products') }}" class="btn-primary text-center">
                        Shop Now
                    </a>
                    <a href="#featured" class="btn-outline text-center">
                        View Featured
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="bg-white rounded-2xl p-8 shadow-xl">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="font-playfair text-2xl font-semibold text-gray-900 mb-2">Organixa</h3>
                        <p class="text-green-600 font-medium">Premium Organic Skincare</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Carousel Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="font-playfair text-3xl font-bold text-gray-900 mb-4">Featured Products</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Discover our most popular organic skincare products, carefully crafted to nourish and enhance your natural beauty.
            </p>
        </div>
        
        <div class="product-carousel">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                <div class="product-card">
                    <div class="relative overflow-hidden">
                        <img src="{{ $product->getFirstImageAttribute() }}" alt="{{ $product->title }}" class="product-image">
                        @if($product->stock <= 10 && $product->stock > 0)
                            <div class="absolute top-4 right-4 bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                Low Stock
                            </div>
                        @endif
                        @if($product->stock == 0)
                            <div class="absolute top-4 right-4 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                Out of Stock
                            </div>
                        @endif
                    </div>
                    <div class="product-info">
                        <span class="product-category">{{ $product->category }}</span>
                        <h3 class="product-title">{{ $product->title }}</h3>
                        <p class="product-benefits">{{ Str::limit($product->benefits, 80) }}</p>
                        <div class="product-price">${{ number_format($product->price, 2) }}</div>
                        <div class="flex gap-2">
                            <a href="{{ route('product.detail', $product->id) }}" class="btn-outline flex-1 text-center">
                                View Details
                            </a>
                            @if($product->isInStock())
                                <button onclick="addToCart({{ $product->id }})" class="btn-primary flex-1">
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
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('products') }}" class="btn-primary">
                View All Products
            </a>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-16 bg-green-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="font-playfair text-3xl font-bold text-gray-900 mb-4">Why Choose Organixa?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                We believe in the power of nature to transform your skin. Our products are crafted with care and commitment to your beauty journey.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-2">100% Natural</h3>
                <p class="text-gray-600">All our products are made with natural, organic ingredients that are safe for your skin and the environment.</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-2">Proven Results</h3>
                <p class="text-gray-600">Our products are clinically tested and proven to deliver visible results for healthier, glowing skin.</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-2">Fast Delivery</h3>
                <p class="text-gray-600">Quick and reliable delivery across Pakistan. Get your favorite products delivered to your doorstep.</p>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="font-playfair text-3xl font-bold text-gray-900 mb-4">Shop by Category</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Explore our comprehensive range of organic skincare products for every step of your beauty routine.
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php
                $categories = ['Face Masks', 'Serums', 'Moisturizers', 'Cleansers', 'Toners', 'Exfoliators', 'Night Care', 'Sunscreen'];
            @endphp
            
            @foreach($categories as $category)
            <a href="{{ route('products') }}?category={{ urlencode($category) }}" class="group">
                <div class="bg-green-50 rounded-xl p-6 text-center transition-all duration-300 group-hover:bg-green-100 group-hover:transform group-hover:scale-105">
                    <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-300">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                        </svg>
                    </div>
                    <h3 class="font-medium text-gray-900 group-hover:text-green-700">{{ $category }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-gradient-to-r from-green-600 to-emerald-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-playfair text-3xl font-bold text-white mb-4">Stay Connected</h2>
        <p class="text-green-100 mb-8 text-lg">
            Subscribe to our newsletter for exclusive offers, skincare tips, and new product launches.
        </p>
        <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-lg border-0 focus:ring-2 focus:ring-white focus:ring-opacity-50">
            <button type="submit" class="bg-white text-green-600 px-6 py-3 rounded-lg font-medium hover:bg-green-50 transition-colors">
                Subscribe
            </button>
        </form>
    </div>
</section>
@endsection 