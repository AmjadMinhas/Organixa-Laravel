<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CartItem;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share cart count with all views
        View::composer('*', function ($view) {
            $cartCount = 0;
            
            if (auth()->check()) {
                $cartCount = auth()->user()->cartItems->sum('quantity');
            } else {
                $sessionCart = session('cart', []);
                $cartCount = array_sum($sessionCart);
            }
            
            $view->with('cartCount', $cartCount);
        });
    }
}
