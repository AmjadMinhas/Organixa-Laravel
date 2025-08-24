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
            return redirect()->back()->with('error', 'Product is out of stock.');
        }

        if (Auth::check()) {
            // If user is logged in, save to database
            $cartItem = Auth::user()->cartItems()->where('product_id', $request->product_id)->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $request->quantity);
            } else {
                $cartItem = Auth::user()->cartItems()->create([
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

        $cartCount = $this->getCartCount();
        $cartTotal = $this->getCartTotal();

        // Return JSON response for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Product added to cart successfully',
                'cart_count' => $cartCount,
                'cart_total' => $cartTotal
            ]);
        }

        // Return redirect for regular form submissions
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    private function getCartCount()
    {
        if (Auth::check()) {
            return Auth::user()->cartItems->sum('quantity');
        } else {
            return array_sum(session('cart', []));
        }
    }

    private function getCartTotal()
    {
        if (Auth::check()) {
            return Auth::user()->cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });
        } else {
            $total = 0;
            $sessionCart = session('cart', []);
            foreach ($sessionCart as $productId => $quantity) {
                $product = Product::find($productId);
                if ($product) {
                    $total += $product->price * $quantity;
                }
            }
            return $total;
        }
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
