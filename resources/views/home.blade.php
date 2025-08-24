@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative py-24 bg-gradient-subtle">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <div class="space-y-6">
                    <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-text leading-tight">
                        Natural Beauty, 
                        <span class="text-gradient">Organic Care</span>
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl text-text-light leading-relaxed max-w-lg">
                        Discover our premium organic skincare collection, crafted with natural ingredients 
                        for your skin's health and radiance.
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products') }}" class="btn-primary">
                        Shop Collection
                    </a>
                    <a href="#featured" class="btn-outline">
                        View Featured
                    </a>
                </div>
                
                <!-- Feature highlights -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-8 pt-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-accent rounded-full"></div>
                        <div>
                            <div class="font-semibold text-text text-sm sm:text-base">100% Natural</div>
                            <div class="text-xs sm:text-sm text-text-light">Ingredients</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-primary rounded-full"></div>
                        <div>
                            <div class="font-semibold text-text text-sm sm:text-base">Cruelty-free</div>
                            <div class="text-xs sm:text-sm text-text-light">Products</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-accent rounded-full"></div>
                        <div>
                            <div class="font-semibold text-text text-sm sm:text-base">Eco-friendly</div>
                            <div class="text-xs sm:text-sm text-text-light">Packaging</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <div class="card p-8 shadow-xl">
                    <div class="text-center space-y-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-light rounded-full flex items-center justify-center mx-auto shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-serif text-2xl font-semibold text-text mb-2">Organixa</h3>
                            <p class="text-accent font-medium">Premium Organic Skincare</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section id="featured" class="py-20 bg-white">
    <div class="container mx-auto">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="font-serif text-2xl sm:text-3xl md:text-4xl font-bold text-text mb-4 sm:mb-6">Featured Products</h2>
            <p class="text-text-light text-base sm:text-lg max-w-2xl mx-auto px-4">
                Discover our most popular organic skincare products, carefully crafted to nourish and enhance your natural beauty.
            </p>
        </div>
        
        @livewire('featured-products')
        
        <div class="text-center mt-12">
            <a href="{{ route('products') }}" class="btn-primary">
                View All Products
            </a>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-20 bg-gradient-subtle">
    <div class="container mx-auto">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="font-serif text-2xl sm:text-3xl md:text-4xl font-bold text-text mb-4 sm:mb-6">Why Choose Organixa?</h2>
            <p class="text-text-light text-base sm:text-lg max-w-2xl mx-auto px-4">
                We believe in the power of nature to transform your skin. Our products are crafted with care and commitment to your beauty journey.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="text-center group">
                <div class="w-16 h-16 bg-gradient-to-br from-accent to-accent-light rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="font-serif text-xl font-semibold text-text mb-4">100% Natural</h3>
                <p class="text-text-light">All our products are made with natural, organic ingredients that are safe for your skin and the environment.</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 h-16 bg-gradient-to-br from-primary to-primary-light rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-serif text-xl font-semibold text-text mb-4">Proven Results</h3>
                <p class="text-text-light">Our products are clinically tested and proven to deliver visible results for healthier, glowing skin.</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 h-16 bg-gradient-to-br from-accent to-accent-light rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-serif text-xl font-semibold text-text mb-4">Fast Delivery</h3>
                <p class="text-text-light">Quick and reliable delivery across Pakistan. Get your favorite products delivered to your doorstep.</p>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="font-serif text-4xl font-bold text-text mb-6">Shop by Category</h2>
            <p class="text-text-light text-lg max-w-2xl mx-auto">
                Explore our comprehensive range of organic skincare products for every step of your beauty routine.
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php
                $categories = [
                    ['name' => 'Face Masks', 'icon' => '🧖‍♀️'],
                    ['name' => 'Serums', 'icon' => '💧'],
                    ['name' => 'Moisturizers', 'icon' => '🧴'],
                    ['name' => 'Cleansers', 'icon' => '🧼'],
                    ['name' => 'Toners', 'icon' => '🌊'],
                    ['name' => 'Exfoliators', 'icon' => '✨'],
                    ['name' => 'Night Care', 'icon' => '🌙'],
                    ['name' => 'Sunscreen', 'icon' => '☀️']
                ];
            @endphp
            
            @foreach($categories as $category)
            <a href="{{ route('products') }}?category={{ urlencode($category['name']) }}" class="group">
                <div class="bg-gradient-subtle rounded-2xl p-8 text-center transition-all duration-300 group-hover:bg-white group-hover:shadow-lg group-hover:transform group-hover:scale-105 border border-border-light group-hover:border-accent">
                    <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">
                        {{ $category['icon'] }}
                    </div>
                    <h3 class="font-serif font-semibold text-text group-hover:text-primary text-lg">{{ $category['name'] }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-20 bg-gradient-to-r from-primary to-primary-light">
    <div class="container mx-auto">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="font-serif text-4xl font-bold text-white mb-6">Stay Connected</h2>
            <p class="text-white/90 text-xl mb-10">
                Subscribe to our newsletter for exclusive offers, skincare tips, and new product launches.
            </p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Enter your email" class="flex-1 px-6 py-4 rounded-xl border-0 focus:ring-2 focus:ring-white focus:ring-opacity-50 text-text font-medium">
                <button type="submit" class="bg-white text-primary px-8 py-4 rounded-xl font-semibold hover:bg-gray-50 transition-colors duration-300 shadow-lg">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</section>
@endsection 