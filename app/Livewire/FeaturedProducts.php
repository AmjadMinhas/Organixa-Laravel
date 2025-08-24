<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class FeaturedProducts extends Component
{
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        
        if (!$product->isInStock()) {
            session()->flash('error', 'Product is out of stock.');
            return;
        }

        if (auth()->check()) {
            // If user is logged in, save to database
            $cartItem = auth()->user()->cartItems()->where('product_id', $productId)->first();

            if ($cartItem) {
                $cartItem->increment('quantity');
            } else {
                auth()->user()->cartItems()->create([
                    'product_id' => $productId,
                    'quantity' => 1,
                ]);
            }
        } else {
            // If user is not logged in, save to session
            $cart = session('cart', []);
            
            if (isset($cart[$productId])) {
                $cart[$productId]++;
            } else {
                $cart[$productId] = 1;
            }
            
            session(['cart' => $cart]);
        }

        session()->flash('success', 'Product added to cart successfully!');
        
        // Dispatch browser event to update cart dropdown
        $this->dispatch('cart-updated');
        
        // Also dispatch a custom event with cart data
        $cartCount = auth()->check() ? auth()->user()->cartItems->sum('quantity') : array_sum(session('cart', []));
        $this->dispatch('cart-count-updated', count: $cartCount);
    }

    public function render()
    {
        $featuredProducts = Product::where('featured', true)
            ->where('is_active', true)
            ->take(8)
            ->get();

        return view('livewire.featured-products', [
            'featuredProducts' => $featuredProducts
        ]);
    }
}
