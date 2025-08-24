@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative py-20 bg-gradient-subtle">
    <div class="container mx-auto">
        <div class="text-center">
            <h1 class="font-serif text-5xl lg:text-6xl font-bold text-text mb-6">
                About Organixa
            </h1>
            <p class="text-xl text-text-light max-w-2xl mx-auto leading-relaxed">
                Your journey to natural beauty starts here. Discover the story behind our commitment to organic skincare.
            </p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <div class="w-20 h-20 bg-gradient-to-br from-accent to-accent-light rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <p class="text-xl text-text-light leading-relaxed">
                    Welcome to Organixa, your trusted destination for premium organic skincare products. 
                    We believe in the power of nature to transform your skin and enhance your natural beauty.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                <div>
                    <h2 class="font-serif text-3xl font-bold text-text mb-6">Our Mission</h2>
                    <p class="text-text-light leading-relaxed text-lg">
                        At Organixa, we are committed to providing you with the highest quality organic skincare products 
                        that are not only effective but also safe for your skin and the environment. Our products are 
                        carefully crafted using natural ingredients sourced from the finest organic farms.
                    </p>
                </div>
                <div class="card p-8">
                    <h3 class="font-serif text-2xl font-semibold text-text mb-4">Our Values</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center text-text-light">
                            <div class="w-2 h-2 bg-accent rounded-full mr-3"></div>
                            Sustainability & Eco-friendliness
                        </li>
                        <li class="flex items-center text-text-light">
                            <div class="w-2 h-2 bg-accent rounded-full mr-3"></div>
                            Natural & Organic Ingredients
                        </li>
                        <li class="flex items-center text-text-light">
                            <div class="w-2 h-2 bg-accent rounded-full mr-3"></div>
                            Cruelty-free Products
                        </li>
                        <li class="flex items-center text-text-light">
                            <div class="w-2 h-2 bg-accent rounded-full mr-3"></div>
                            Quality & Effectiveness
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mb-16">
                <h2 class="font-serif text-3xl font-bold text-text mb-6 text-center">Why Choose Us?</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-gradient-to-br from-accent to-accent-light rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-serif text-xl font-semibold text-text mb-2">100% Natural</h3>
                        <p class="text-text-light">All ingredients are sourced from organic farms and natural sources.</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-primary-light rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-serif text-xl font-semibold text-text mb-2">Proven Results</h3>
                        <p class="text-text-light">Clinically tested products with visible, long-lasting results.</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-gradient-to-br from-accent to-accent-light rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-serif text-xl font-semibold text-text mb-2">Fast Delivery</h3>
                        <p class="text-text-light">Quick and reliable delivery across Pakistan.</p>
                    </div>
                </div>
            </div>

            <div class="mb-16">
                <h2 class="font-serif text-3xl font-bold text-text mb-6 text-center">Our Story</h2>
                <div class="card p-8">
                    <p class="text-text-light leading-relaxed text-lg">
                        Founded with a passion for natural beauty and sustainable living, Organixa was born from the 
                        belief that everyone deserves access to high-quality organic skincare products. Our journey 
                        began with a simple idea: to create products that not only make you look beautiful but also 
                        feel beautiful from within.
                    </p>
                    <p class="text-text-light leading-relaxed text-lg mt-6">
                        Today, we continue to uphold these values while expanding our range of products to meet the 
                        diverse needs of our customers. Every product we create is a testament to our commitment to 
                        quality, sustainability, and the power of natural ingredients.
                    </p>
                </div>
            </div>

            <div class="text-center">
                <div class="card p-8 shadow-xl">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-primary-light rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="font-serif text-2xl font-semibold text-text mb-4">Get in Touch</h3>
                    <p class="text-text-light mb-6 text-lg">
                        Have questions about our products or need personalized skincare advice? 
                        We're here to help you on your beauty journey.
                    </p>
                    <a href="{{ route('contact') }}" class="btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 