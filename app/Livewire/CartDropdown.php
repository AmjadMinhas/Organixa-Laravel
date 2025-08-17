<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Product;
use Livewire\Component;

class CartDropdown extends Component
{
    protected $listeners = ['cart-updated' => '$refresh'];

    public function render()
    {
        $cartItems = collect();
        $cartTotal = 0;
        $cartCount = 0;

        if (auth()->check()) {
            $cartItems = auth()->user()->cartItems()->with('product')->take(3)->get();
            $cartTotal = auth()->user()->cartItems->sum(function($item) { 
                return $item->product->price * $item->quantity; 
            });
            $cartCount = auth()->user()->cartItems->sum('quantity');
        } else {
            $sessionCart = session('cart', []);
            $count = 0;
            foreach ($sessionCart as $productId => $quantity) {
                if ($count >= 3) break;
                $product = Product::find($productId);
                if ($product) {
                    $cartItems->push((object) [
                        'product' => $product,
                        'quantity' => $quantity,
                        'subtotal' => $product->price * $quantity
                    ]);
                    $cartTotal += $product->price * $quantity;
                    $count++;
                }
            }
            $cartCount = array_sum($sessionCart);
        }

        return view('livewire.cart-dropdown', compact('cartItems', 'cartTotal', 'cartCount'));
    }
} 