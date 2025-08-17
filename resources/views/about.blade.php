@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">About Organixa</h1>
        <p class="text-xl text-gray-600">Your journey to natural beauty starts here</p>
    </div>

    <div class="prose prose-lg max-w-none">
        <p class="text-gray-600 mb-8">
            Welcome to Organixa, your trusted destination for premium organic skincare products. 
            We believe in the power of nature to transform your skin and enhance your natural beauty.
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h2>
        <p class="text-gray-600 mb-8">
            At Organixa, we are committed to providing you with the highest quality organic skincare products 
            that are not only effective but also safe for your skin and the environment. Our products are 
            carefully crafted using natural ingredients sourced from the finest organic farms.
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">Why Choose Us?</h2>
        <ul class="list-disc list-inside text-gray-600 mb-8 space-y-2">
            <li>100% Natural and Organic Ingredients</li>
            <li>Cruelty-free and Environmentally Friendly</li>
            <li>Clinically Tested and Proven Results</li>
            <li>Made in Pakistan with Love</li>
            <li>Fast and Reliable Delivery</li>
        </ul>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Story</h2>
        <p class="text-gray-600 mb-8">
            Founded with a passion for natural beauty and sustainable living, Organixa was born from the 
            belief that everyone deserves access to high-quality organic skincare products. Our journey 
            began with a simple idea: to create products that not only make you look beautiful but also 
            feel beautiful from within.
        </p>

        <div class="bg-green-50 rounded-lg p-8 mt-12">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Get in Touch</h3>
            <p class="text-gray-600 mb-4">
                Have questions about our products or need personalized skincare advice? 
                We're here to help you on your beauty journey.
            </p>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                Contact Us
            </a>
        </div>
    </div>
</div>
@endsection 