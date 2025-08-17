@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Profile</h1>
        <p class="mt-2 text-gray-600">Manage your account information</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Personal Information</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <p class="text-sm text-gray-900">{{ auth()->user()->name }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <p class="text-sm text-gray-900">{{ auth()->user()->email }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <p class="text-sm text-gray-900">{{ auth()->user()->phone ?? 'Not provided' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                <p class="text-sm text-gray-900">{{ auth()->user()->city ?? 'Not provided' }}</p>
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <p class="text-sm text-gray-900">{{ auth()->user()->address ?? 'Not provided' }}</p>
            </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-medium text-gray-900">Account Actions</h3>
                    <p class="text-sm text-gray-500">Manage your account settings</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('orders') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        View Orders
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 