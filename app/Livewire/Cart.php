<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public function updateQuantity($cartItemId, $quantity)
    {
        if ($quantity < 1) {
            return;
        }

        if (auth()->check()) {
            $cartItem = CartItem::where('id', $cartItemId)
                ->where('user_id', auth()->id())
                ->first();

            if ($cartItem) {
                $cartItem->update(['quantity' => $quantity]);
            }
        } else {
            // Update session cart
            $cart = session('cart', []);
            if (isset($cart[$cartItemId])) {
                $cart[$cartItemId] = $quantity;
                session(['cart' => $cart]);
            }
        }
        
        $this->dispatch('cart-updated');
    }

    public function removeFromCart($cartItemId)
    {
        if (auth()->check()) {
            $cartItem = CartItem::where('id', $cartItemId)
                ->where('user_id', auth()->id())
                ->first();

            if ($cartItem) {
                $cartItem->delete();
            }
        } else {
            // Remove from session cart
            $cart = session('cart', []);
            unset($cart[$cartItemId]);
            session(['cart' => $cart]);
        }
        
        $this->dispatch('cart-updated');
    }

    public function clearCart()
    {
        if (auth()->check()) {
            auth()->user()->cartItems()->delete();
        } else {
            session()->forget('cart');
        }
        
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $cartItems = collect();
        $total = 0;

        if (auth()->check()) {
            $cartItems = auth()->user()->cartItems()->with('product')->get();
            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });
        } else {
            // Get cart from session
            $sessionCart = session('cart', []);
            foreach ($sessionCart as $productId => $quantity) {
                $product = Product::find($productId);
                if ($product) {
                    $cartItems->push((object) [
                        'id' => $productId,
                        'product' => $product,
                        'quantity' => $quantity,
                        'subtotal' => $product->price * $quantity
                    ]);
                    $total += $product->price * $quantity;
                }
            }
        }

        return view('livewire.cart', compact('cartItems', 'total'));
    }
}
