@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center">
        <!-- Success Icon -->
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-6">
            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <!-- Success Message -->
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Order Placed Successfully!</h1>
        <p class="text-lg text-gray-600 mb-8">
            Thank you for your order. Your order number is:
        </p>
        
        <!-- Order Number -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <p class="text-sm text-gray-600 mb-2">Order Number</p>
            <p class="text-2xl font-bold text-gray-900">{{ $order->order_number }}</p>
        </div>

        <!-- Order Details -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Details</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Shipping Information</h3>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p><strong>Address:</strong> {{ $order->address }}</p>
                        <p><strong>City:</strong> {{ $order->city }}</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Order Summary</h3>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p><strong>Total Amount:</strong> ₨{{ number_format($order->total_amount) }}</p>
                        <p><strong>Status:</strong> <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">{{ ucfirst($order->status) }}</span></p>
                        <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Order Items -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-sm font-medium text-gray-900 mb-3">Order Items</h3>
                <div class="space-y-3">
                    @foreach($order->orderItems as $item)
                        <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <img src="{{ $item->product->first_image }}" alt="{{ $item->product->title }}" class="w-12 h-12 object-cover rounded-md">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 truncate">{{ $item->product->title }}</h4>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">₨{{ number_format($item->price * $item->quantity) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a 
                href="{{ route('home') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
            >
                Continue Shopping
            </a>
            <a 
                href="{{ route('orders') }}"
                class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
            >
                View My Orders
            </a>
        </div>
    </div>
</div>
@endsection 