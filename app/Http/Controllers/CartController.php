<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = collect();
        $total = 0;

        if (Auth::check()) {
            // If user is logged in, get cart from database
            $cartItems = Auth::user()->cartItems()->with('product')->get();
            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });
        } else {
            // If user is not logged in, get cart from session
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

        return view('cart', compact('cartItems', 'total'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        if (!$product->isInStock()) {
            return response()->json(['error' => 'Product is out of stock'], 400);
        }

        if (Auth::check()) {
            // If user is logged in, save to database
            $cartItem = Auth::user()->cartItems()->where('product_id', $request->product_id)->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $request->quantity);
            } else {
                Auth::user()->cartItems()->create([
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ]);
            }
        } else {
            // If user is not logged in, save to session
            $cart = session('cart', []);
            $productId = $request->product_id;
            
            if (isset($cart[$productId])) {
                $cart[$productId] += $request->quantity;
            } else {
                $cart[$productId] = $request->quantity;
            }
            
            session(['cart' => $cart]);
        }

        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function updateCart(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if (Auth::check()) {
            $cartItem = CartItem::where('id', $cartItemId)
                ->where('user_id', Auth::id())
                ->first();

            if ($cartItem) {
                $cartItem->update(['quantity' => $request->quantity]);
            }
        } else {
            // Update session cart
            $cart = session('cart', []);
            if (isset($cart[$cartItemId])) {
                $cart[$cartItemId] = $request->quantity;
                session(['cart' => $cart]);
            }
        }

        return response()->json(['message' => 'Cart updated successfully']);
    }

    public function removeFromCart($cartItemId)
    {
        if (Auth::check()) {
            $cartItem = CartItem::where('id', $cartItemId)
                ->where('user_id', Auth::id())
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

        return response()->json(['message' => 'Item removed from cart']);
    }

    public function clearCart()
    {
        if (Auth::check()) {
            Auth::user()->cartItems()->delete();
        } else {
            session()->forget('cart');
        }

        return response()->json(['message' => 'Cart cleared successfully']);
    }
}
