<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the home page with featured products.
     */
    public function index()
    {
        $featuredProducts = Product::featured()->active()->take(8)->get();
        
        // If no featured products, get some active products
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::active()->take(8)->get();
        }
        
        return view('home', compact('featuredProducts'));
    }
} 