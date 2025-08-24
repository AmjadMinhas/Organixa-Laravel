<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetailCart extends Component
{
    public $quantity = 1;
    public $product;

    public function mount($product = null)
    {
        if ($product) {
            $this->product = $product;
        }
    }

    public function increaseQuantity()
    {
        if ($this->quantity < 99) {
            $this->quantity++;
        }
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

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
                $cartItem->increment('quantity', $this->quantity);
            } else {
                auth()->user()->cartItems()->create([
                    'product_id' => $productId,
                    'quantity' => $this->quantity,
                ]);
            }
        } else {
            // If user is not logged in, save to session
            $cart = session('cart', []);
            
            if (isset($cart[$productId])) {
                $cart[$productId] += $this->quantity;
            } else {
                $cart[$productId] = $this->quantity;
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
        return view('livewire.product-detail-cart');
    }
}


