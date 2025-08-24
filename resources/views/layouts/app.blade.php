<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Organixa - Organic Skincare') }}</title>
     <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white/95 backdrop-blur-sm border-b border-gray-100 sticky top-0 z-50" style="background-color: #f5f5f5;">
            <div class="container mx-auto">
                <div class="flex justify-between items-center h-20 min-w-0">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                            <div class="w-32 h-32 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/logo.png') }}" alt="Organixa Logo" class="w-full h-full object-contain">
                            </div>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden lg:flex items-center space-x-2">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            Home
                        </a>
                        <a href="{{ route('products') }}" class="nav-link {{ request()->routeIs('products*') ? 'active' : '' }}">
                            Products
                        </a>
                        <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                            About
                        </a>
                        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                            Contact
                        </a>
                    </div>

                    <!-- Right side -->
                    <div class="flex items-center space-x-2 sm:space-x-4 min-w-0">
                        <!-- Cart Dropdown -->
                        @livewire('cart-dropdown')

                        <!-- Admin Link -->
                        <div class="hidden lg:block">
                            <a href="{{ route('admin.login') }}" class="text-text-light hover:text-primary px-4 py-2 rounded-lg text-sm font-medium hover:bg-surface-alt transition-colors duration-300">Admin</a>
                        </div>

                        <!-- User Menu -->
                        <div class="relative">
                            @auth
                                <div class="relative">
                                    <button class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary hover:scale-105 transition-transform duration-300" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <div class="h-9 w-9 rounded-full bg-gradient-to-br from-primary to-primary-light flex items-center justify-center shadow-sm">
                                            <span class="text-sm font-medium text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                        </div>
                                    </button>
                                    <div class="origin-top-right absolute right-0 mt-3 w-48 rounded-xl shadow-lg py-2 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden border border-gray-100" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" id="user-menu">
                                        <a href="{{ route('profile') }}" class="block px-4 py-3 text-sm text-text hover:bg-surface-alt hover:text-primary transition-colors duration-200" role="menuitem" tabindex="-1">Profile</a>
                                        @if(auth()->user()->isAdmin())
                                            <a href="{{ route('admin') }}" class="block px-4 py-3 text-sm text-text hover:bg-surface-alt hover:text-primary transition-colors duration-200" role="menuitem" tabindex="-1">Admin Panel</a>
                                        @endif
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-text hover:bg-red-50 hover:text-red-600 transition-colors duration-200" role="menuitem" tabindex="-1">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('login') }}" class="text-text-light hover:text-primary px-4 py-2 rounded-lg text-sm font-medium hover:bg-surface-alt transition-colors duration-300">Login</a>
                                    <a href="{{ route('register') }}" class="btn-primary">Register</a>
                                </div>
                            @endauth
                        </div>

                        <!-- Mobile menu button -->
                        <div class="lg:hidden">
                            <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-lg text-text-light hover:text-primary hover:bg-surface-alt focus:outline-none focus:bg-surface-alt focus:text-primary transition duration-150 ease-in-out" aria-label="Main menu" aria-expanded="false">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden lg:hidden">
                <div class="px-4 pt-2 pb-3 space-y-1 bg-white border-t border-gray-100">
                    <a href="{{ route('home') }}" class="block px-3 py-3 rounded-lg text-base font-medium text-text hover:text-primary hover:bg-surface-alt transition-colors duration-200">
                        Home
                    </a>
                    <a href="{{ route('products') }}" class="block px-3 py-3 rounded-lg text-base font-medium text-text hover:text-primary hover:bg-surface-alt transition-colors duration-200">
                        Products
                    </a>
                    <a href="{{ route('about') }}" class="block px-3 py-3 rounded-lg text-base font-medium text-text hover:text-primary hover:bg-surface-alt transition-colors duration-200">
                        About
                    </a>
                    <a href="{{ route('contact') }}" class="block px-3 py-3 rounded-lg text-base font-medium text-text hover:text-primary hover:bg-surface-alt transition-colors duration-200">
                        Contact
                    </a>
                    
                    <!-- Mobile Cart -->
                    <div class="px-3 py-2">
                        <a href="{{ route('cart') }}" class="flex items-center text-base font-medium text-text hover:text-primary hover:bg-surface-alt rounded-lg px-3 py-3 transition-colors duration-200">
                            <svg class="h-5 w-5 mr-3 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Cart
                            <span class="ml-auto h-6 w-6 bg-primary text-white text-xs rounded-full flex items-center justify-center cart-count" style="display: {{ $cartCount > 0 ? 'flex' : 'none' }};">
                                {{ $cartCount }}
                            </span>
                        </a>
                    </div>
                    
                    <!-- Mobile Auth Links -->
                    <div class="px-3 py-2 border-t border-gray-100">
                        @auth
                            <a href="{{ route('profile') }}" class="block px-3 py-3 rounded-lg text-base font-medium text-text hover:text-primary hover:bg-surface-alt transition-colors duration-200">
                                Profile
                            </a>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin') }}" class="block px-3 py-3 rounded-lg text-base font-medium text-text hover:text-primary hover:bg-surface-alt transition-colors duration-200">
                                    Admin Panel
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-3 py-3 rounded-lg text-base font-medium text-text hover:text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block px-3 py-3 rounded-lg text-base font-medium text-text hover:text-primary hover:bg-surface-alt transition-colors duration-200">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="block px-3 py-3 rounded-lg text-base font-medium text-white bg-primary hover:bg-primary-dark transition-colors duration-200 mt-2">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-100 mt-20">
            <div class="container mx-auto py-16">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-12 h-12 flex items-center justify-center">
                                <img src="{{ asset('images/logo.png') }}" alt="Organixa Logo" class="w-full h-full object-contain">
                            </div>
                            <div>
                                <span class="font-serif text-2xl font-semibold text-text">organixa</span>
                                <div class="text-sm text-text-muted -mt-1">organic skincare</div>
                            </div>
                        </div>
                        <p class="text-text-light text-sm max-w-md leading-relaxed">
                            Discover the power of nature with our premium organic skincare collection. 
                            Crafted with natural ingredients for your skin's health and radiance.
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="font-serif font-semibold text-text mb-6 text-lg">Quick Links</h3>
                        <ul class="space-y-4">
                            <li><a href="{{ route('home') }}" class="text-text-light hover:text-primary text-sm transition-colors duration-300">Home</a></li>
                            <li><a href="{{ route('products') }}" class="text-text-light hover:text-primary text-sm transition-colors duration-300">Products</a></li>
                            <li><a href="{{ route('about') }}" class="text-text-light hover:text-primary text-sm transition-colors duration-300">About Us</a></li>
                            <li><a href="{{ route('contact') }}" class="text-text-light hover:text-primary text-sm transition-colors duration-300">Contact</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="font-serif font-semibold text-text mb-6 text-lg">Support</h3>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-text-light hover:text-primary text-sm transition-colors duration-300">FAQ</a></li>
                            <li><a href="#" class="text-text-light hover:text-primary text-sm transition-colors duration-300">Shipping Info</a></li>
                            <li><a href="#" class="text-text-light hover:text-primary text-sm transition-colors duration-300">Returns</a></li>
                            <li><a href="#" class="text-text-light hover:text-primary text-sm transition-colors duration-300">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="section-divider"></div>
                
                <div class="text-center">
                    <p class="text-text-muted text-sm">
                        © {{ date('Y') }} Organixa. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
                    
                    if (isExpanded) {
                        mobileMenu.classList.add('hidden');
                        mobileMenuButton.setAttribute('aria-expanded', 'false');
                    } else {
                        mobileMenu.classList.remove('hidden');
                        mobileMenuButton.setAttribute('aria-expanded', 'true');
                    }
                });
                
                // Close mobile menu when clicking on a link
                const mobileMenuLinks = mobileMenu.querySelectorAll('a');
                mobileMenuLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.add('hidden');
                        mobileMenuButton.setAttribute('aria-expanded', 'false');
                    });
                });
            }
            
            // User menu functionality
            const userMenuButton = document.getElementById('user-menu-button');
            const userMenu = document.getElementById('user-menu');
            
            if (userMenuButton && userMenu) {
                userMenuButton.addEventListener('click', function() {
                    const isExpanded = userMenuButton.getAttribute('aria-expanded') === 'true';
                    
                    if (isExpanded) {
                        userMenu.classList.add('hidden');
                        userMenuButton.setAttribute('aria-expanded', 'false');
                    } else {
                        userMenu.classList.remove('hidden');
                        userMenuButton.setAttribute('aria-expanded', 'true');
                    }
                });
                
                // Close user menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                        userMenu.classList.add('hidden');
                        userMenuButton.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    </script>
</body>
</html> 