@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="font-playfair text-3xl font-bold text-gray-900">Add New Product</h1>
                    <p class="text-gray-600">Create a new organic skincare product</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.products.index') }}" class="btn-outline">
                        Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="font-playfair text-xl font-semibold text-gray-900">Product Information</h2>
            </div>
            
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Product Title *</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="form-input @error('title') border-red-500 @enderror" placeholder="e.g., GLOWLIN Hydrating Clay Mask">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <select name="category" id="category" required class="form-input @error('category') border-red-500 @enderror">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($) *</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required
                                class="form-input @error('price') border-red-500 @enderror" placeholder="29.99">
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stock Quantity *</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0" required
                                class="form-input @error('stock') border-red-500 @enderror" placeholder="50">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="size" class="block text-sm font-medium text-gray-700 mb-2">Size</label>
                            <input type="text" name="size" id="size" value="{{ old('size') }}"
                                class="form-input @error('size') border-red-500 @enderror" placeholder="e.g., 100g, 30ml">
                            @error('size')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="space-y-6">
                        <div>
                            <label for="benefits" class="block text-sm font-medium text-gray-700 mb-2">Benefits</label>
                            <textarea name="benefits" id="benefits" rows="3"
                                class="form-input @error('benefits') border-red-500 @enderror" 
                                placeholder="e.g., Hydrates your skin for 24 hours, Promotes natural glowing skin, Natural ingredients">{{ old('benefits') }}</textarea>
                            @error('benefits')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="ingredients" class="block text-sm font-medium text-gray-700 mb-2">Ingredients</label>
                            <textarea name="ingredients" id="ingredients" rows="3"
                                class="form-input @error('ingredients') border-red-500 @enderror" 
                                placeholder="e.g., Natural Clay, Aloe Vera, Green Tea Extract, Vitamin E, Jojoba Oil">{{ old('ingredients') }}</textarea>
                            @error('ingredients')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Product Images</label>
                            <input type="file" name="images[]" id="images" multiple accept="image/*"
                                class="form-input @error('images.*') border-red-500 @enderror">
                            <p class="mt-1 text-sm text-gray-500">Upload multiple images (JPEG, PNG, GIF up to 2MB each)</p>
                            @error('images.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }}
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="featured" class="ml-2 block text-sm text-gray-700">
                                    Featured Product
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                    Active Product
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Product Description *</label>
                    <textarea name="description" id="description" rows="6" required
                        class="form-input @error('description') border-red-500 @enderror" 
                        placeholder="Describe your product in detail...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('admin.products.index') }}" class="btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 