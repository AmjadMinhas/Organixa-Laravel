@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Order Details</h1>
                <p class="mt-2 text-gray-600">Order #{{ $order->order_number }}</p>
            </div>
            <a href="{{ route('orders') }}" class="text-green-600 hover:text-green-700 text-sm font-medium">
                ← Back to Orders
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Order Information -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Information</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Order Number:</span>
                        <span class="text-sm font-medium text-gray-900">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Order Date:</span>
                        <span class="text-sm font-medium text-gray-900">{{ $order->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Status:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                            @elseif($order->status === 'delivered') bg-green-100 text-green-800
                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Total Amount:</span>
                        <span class="text-sm font-medium text-gray-900">₨{{ number_format($order->total_amount) }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Shipping Information</h2>
                <div class="space-y-2">
                                            <p class="text-sm"><strong>Name:</strong> {{ $order->customer_name }}</p>
                        <p class="text-sm"><strong>Email:</strong> {{ $order->customer_email }}</p>
                        <p class="text-sm"><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p class="text-sm"><strong>Address:</strong> {{ $order->address }}</p>
                        <p class="text-sm"><strong>City:</strong> {{ $order->city }}</p>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Items</h2>
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                        <div class="flex-shrink-0">
                            <img src="{{ $item->product->first_image }}" alt="{{ $item->product->title }}" class="w-16 h-16 object-cover rounded-md">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-medium text-gray-900 truncate">
                                <a href="{{ route('product.detail', $item->product) }}" class="hover:text-green-600">
                                    {{ $item->product->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-500">{{ Str::limit($item->product->description, 60) }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">₨{{ number_format($item->price) }}</p>
                            <p class="text-sm text-gray-500">Total: ₨{{ number_format($item->price * $item->quantity) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="text-gray-900">₨{{ number_format($order->total_amount) }}</span>
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
                            <span class="text-gray-900">₨{{ number_format($order->total_amount) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 