@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Our Products</h1>
        <p class="mt-2 text-gray-600">Discover our premium organic skincare collection</p>
    </div>

    @livewire('products')
</div>
@endsection 