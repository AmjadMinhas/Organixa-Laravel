<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $orders = Auth::user()->orders()->with('orderItems.product')->latest()->get();
        return view('orders', compact('orders'));
    }

    public function checkout()
    {
        $cartItems = collect();
        $total = 0;

        if (Auth::check()) {
            $cartItems = Auth::user()->cartItems()->with('product')->get();
            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });
        } else {
            // Get cart from session
            $sessionCart = session('cart', []);
            foreach ($sessionCart as $productId => $quantity) {
                $product = \App\Models\Product::find($productId);
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

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        return view('checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('Order placement started', ['request' => $request->all()]);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'city' => 'required|string|max:100',
            ]);

            $cartItems = collect();
            $total = 0;

            if (Auth::check()) {
                $cartItems = Auth::user()->cartItems()->with('product')->get();
                $total = $cartItems->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });
            } else {
                // Get cart from session
                $sessionCart = session('cart', []);
                Log::info('Session cart', ['cart' => $sessionCart]);
                
                foreach ($sessionCart as $productId => $quantity) {
                    $product = \App\Models\Product::find($productId);
                    if ($product) {
                        $cartItems->push((object) [
                            'product_id' => $productId,
                            'product' => $product,
                            'quantity' => $quantity,
                            'price' => $product->price
                        ]);
                        $total += $product->price * $quantity;
                    }
                }
            }
            
            if ($cartItems->isEmpty()) {
                Log::error('Cart is empty');
                return redirect()->route('cart')->with('error', 'Your cart is empty.');
            }

            Log::info('Cart items found', ['count' => $cartItems->count(), 'total' => $total]);

            // Generate random 8-digit order number
            do {
                $orderNumber = str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);
            } while (Order::where('order_number', $orderNumber)->exists());

            Log::info('Generated order number', ['order_number' => $orderNumber]);

            DB::beginTransaction();

            $order = Order::create([
                'user_id' => Auth::id(), // Will be null for guest users
                'order_number' => $orderNumber,
                'total_amount' => $total,
                'status' => 'pending',
                'customer_name' => $request->name,
                'customer_email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
            ]);

            Log::info('Order created', ['order_id' => $order->id]);

            // Create order items from cart items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id ?? $cartItem->product->id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price ?? $cartItem->product->price,
                ]);
            }

            Log::info('Order items created', ['order_id' => $order->id]);

            // Clear the cart
            if (Auth::check()) {
                Auth::user()->cartItems()->delete();
            } else {
                session()->forget('cart');
            }

            Log::info('Cart cleared');

            DB::commit();

            Log::info('Order placement completed successfully', ['order_id' => $order->id]);

            return redirect()->route('order.success', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            Log::error('Order placement failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('order-detail', compact('order'));
    }

    public function success(Order $order)
    {
        return view('order-success', compact('order'));
    }
}
