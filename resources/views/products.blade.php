@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative py-16 bg-gradient-subtle">
    <div class="container mx-auto">
        <div class="text-center">
            <h1 class="font-serif text-4xl lg:text-5xl font-bold text-text mb-6">
                Our Products
            </h1>
            <p class="text-xl text-text-light max-w-2xl mx-auto leading-relaxed">
                Discover our premium organic skincare collection, carefully crafted with natural ingredients for your skin's health and radiance.
            </p>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto">
        @livewire('products')
    </div>
</section>
@endsection 