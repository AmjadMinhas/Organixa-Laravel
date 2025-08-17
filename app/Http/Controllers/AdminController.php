<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function showLogin()
    {
        // Show the login form
        return view('admin.admin-login'); // your blade file
    }
    
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Regenerate session for security
            $request->session()->regenerate();
    
            // Redirect to dashboard instead of returning view directly
            return redirect()->route('admin.dashboard');
        }
    
        // Authentication failed
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }
    
    public function dashboard()
    {
        // Get dashboard stats
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
        ];
    
        $recent_orders = Order::with('user')->latest()->take(5)->get();
        $low_stock_products = Product::where('stock', '<=', 10)->where('stock', '>', 0)->get();
    
        return view('admin.dashboard', compact('stats', 'recent_orders', 'low_stock_products'));
    }
    public function products()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = [
            'Face Masks', 'Serums', 'Moisturizers', 'Cleansers', 
            'Toners', 'Exfoliators', 'Night Care', 'Sunscreen'
        ];
        
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'benefits' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'size' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'stock' => $request->stock,
            'benefits' => $request->benefits,
            'ingredients' => $request->ingredients,
            'size' => $request->size,
            'featured' => $request->has('featured'),
            'is_active' => $request->has('is_active'),
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = '/storage/' . $path;
            }
            $product->update(['images' => $images]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing a product.
     */
    public function edit(Product $product)
    {
        $categories = [
            'Face Masks', 'Serums', 'Moisturizers', 'Cleansers', 
            'Toners', 'Exfoliators', 'Night Care', 'Sunscreen'
        ];
        
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'benefits' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'size' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'stock' => $request->stock,
            'benefits' => $request->benefits,
            'ingredients' => $request->ingredients,
            'size' => $request->size,
            'featured' => $request->has('featured'),
            'is_active' => $request->has('is_active'),
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            $images = $product->images ?? [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = '/storage/' . $path;
            }
            $product->update(['images' => $images]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    /**
     * Show all orders.
     */
    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show order details.
     */
    public function showOrder(Order $order)
    {
        $order->load('orderItems.product');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Show customers.
     */
    public function customers()
    {
        $customers = User::withCount('orders')->latest()->paginate(15);
        return view('admin.customers.index', compact('customers'));
    }
}
