<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $sortBy = 'latest';
    public $perPage = 12;

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
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
        $query = Product::active();

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Category filter
        if ($this->category) {
            $query->where('category', $this->category);
        }

        // Sorting
        switch ($this->sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate($this->perPage);
        $categories = Product::distinct()->pluck('category')->sort();

        return view('livewire.products', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
