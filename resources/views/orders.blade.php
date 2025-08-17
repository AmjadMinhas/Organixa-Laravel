@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">My Orders</h1>
        <p class="mt-2 text-gray-600">View your order history and track your purchases</p>
    </div>

    @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->order_number }}</h3>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-semibold text-gray-900">₨{{ number_format($order->total_amount) }}</p>
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
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Shipping Information</h4>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                                <p><strong>Address:</strong> {{ $order->address }}</p>
                                <p><strong>City:</strong> {{ $order->city }}</p>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Order Items</h4>
                            <div class="space-y-2">
                                @foreach($order->orderItems as $item)
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ $item->product->first_image }}" alt="{{ $item->product->title }}" class="w-8 h-8 object-cover rounded">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $item->product->title }}</p>
                                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">₨{{ number_format($item->price * $item->quantity) }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <a href="{{ route('orders.show', $order) }}" class="text-green-600 hover:text-green-700 text-sm font-medium">
                            View Details →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No orders found</h3>
            <p class="mt-1 text-sm text-gray-500">
                Start shopping to see your orders here.
            </p>
            <div class="mt-6">
                <a 
                    href="{{ route('products') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700"
                >
                    Browse Products
                </a>
            </div>
        </div>
    @endif
</div>
@endsection 