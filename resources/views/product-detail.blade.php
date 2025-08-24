@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Product Images -->
        <div class="space-y-4">
            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200">
                <img src="{{ $product->getFirstImageAttribute() }}" alt="{{ $product->title }}" class="h-full w-full object-cover object-center">
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
                @livewire('product-detail-cart', ['product' => $product])
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
                        <img src="{{ $relatedProduct->getFirstImageAttribute() }}" alt="{{ $relatedProduct->title }}" class="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300">
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
@endsection 