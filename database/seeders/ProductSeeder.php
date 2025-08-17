<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'title' => 'GLOWLIN Hydrating Clay Mask',
                'description' => 'A deeply nourishing clay mask enriched with natural ingredients to hydrate and revitalize dry skin. This premium mask combines the purifying properties of natural clay with hydrating botanical extracts to leave your skin feeling refreshed and glowing.',
                'price' => 29.99,
                'category' => 'Face Masks',
                'stock' => 50,
                'benefits' => 'Hydrates your skin for 24 hours, Promotes natural glowing skin, Natural ingredients',
                'ingredients' => 'Natural Clay, Aloe Vera, Green Tea Extract, Vitamin E, Jojoba Oil',
                'size' => '100g',
                'featured' => true,
                'images' => [
                    '/images/products/clay-mask-1.jpg',
                    '/images/products/clay-mask-2.jpg',
                    '/images/products/clay-mask-3.jpg'
                ]
            ],
            [
                'title' => 'Organixa Vitamin C Serum',
                'description' => 'Brighten and even your skin tone with our potent Vitamin C serum. Formulated with natural antioxidants and skin-brightening ingredients to reduce dark spots and promote a radiant complexion.',
                'price' => 34.99,
                'category' => 'Serums',
                'stock' => 35,
                'benefits' => 'Brightens skin tone, Reduces dark spots, Anti-aging properties',
                'ingredients' => 'Vitamin C, Hyaluronic Acid, Niacinamide, Green Tea, Licorice Root',
                'size' => '30ml',
                'featured' => true,
                'images' => [
                    '/images/products/vitamin-c-serum-1.jpg',
                    '/images/products/vitamin-c-serum-2.jpg'
                ]
            ],
            [
                'title' => 'Natural Glow Face Cream',
                'description' => 'A luxurious daily moisturizer that provides deep hydration while promoting natural radiance. Perfect for all skin types, this cream absorbs quickly and leaves skin feeling soft and supple.',
                'price' => 24.99,
                'category' => 'Moisturizers',
                'stock' => 60,
                'benefits' => 'Deep hydration, Natural radiance, Suitable for all skin types',
                'ingredients' => 'Shea Butter, Coconut Oil, Aloe Vera, Rosehip Oil, Vitamin E',
                'size' => '50ml',
                'featured' => false,
                'images' => [
                    '/images/products/face-cream-1.jpg',
                    '/images/products/face-cream-2.jpg'
                ]
            ],
            [
                'title' => 'Organic Tea Tree Cleanser',
                'description' => 'Gentle yet effective cleanser with tea tree oil to purify and balance your skin. Removes impurities without stripping natural oils, leaving your skin clean and refreshed.',
                'price' => 19.99,
                'category' => 'Cleansers',
                'stock' => 45,
                'benefits' => 'Purifies skin, Balances oil production, Gentle cleansing',
                'ingredients' => 'Tea Tree Oil, Chamomile, Lavender, Coconut Oil, Glycerin',
                'size' => '150ml',
                'featured' => false,
                'images' => [
                    '/images/products/cleanser-1.jpg',
                    '/images/products/cleanser-2.jpg'
                ]
            ],
            [
                'title' => 'Rose Water Toner',
                'description' => 'A soothing and hydrating toner made from pure rose water. Helps balance pH levels, reduce redness, and prepare your skin for better product absorption.',
                'price' => 16.99,
                'category' => 'Toners',
                'stock' => 40,
                'benefits' => 'Balances pH, Reduces redness, Hydrating',
                'ingredients' => 'Pure Rose Water, Glycerin, Aloe Vera, Vitamin E',
                'size' => '200ml',
                'featured' => false,
                'images' => [
                    '/images/products/toner-1.jpg',
                    '/images/products/toner-2.jpg'
                ]
            ],
            [
                'title' => 'Natural Exfoliating Scrub',
                'description' => 'Gentle exfoliating scrub with natural ingredients to remove dead skin cells and reveal brighter, smoother skin. Perfect for weekly use to maintain healthy skin texture.',
                'price' => 22.99,
                'category' => 'Exfoliators',
                'stock' => 30,
                'benefits' => 'Removes dead skin cells, Reveals brighter skin, Gentle exfoliation',
                'ingredients' => 'Sugar, Coconut Oil, Honey, Vanilla, Vitamin E',
                'size' => '100g',
                'featured' => false,
                'images' => [
                    '/images/products/scrub-1.jpg',
                    '/images/products/scrub-2.jpg'
                ]
            ],
            [
                'title' => 'Anti-Aging Night Cream',
                'description' => 'Rich night cream formulated with natural anti-aging ingredients to repair and rejuvenate skin while you sleep. Wake up to firmer, more youthful-looking skin.',
                'price' => 39.99,
                'category' => 'Night Care',
                'stock' => 25,
                'benefits' => 'Anti-aging, Skin repair, Overnight rejuvenation',
                'ingredients' => 'Retinol, Peptides, Hyaluronic Acid, Rosehip Oil, Shea Butter',
                'size' => '50ml',
                'featured' => true,
                'images' => [
                    '/images/products/night-cream-1.jpg',
                    '/images/products/night-cream-2.jpg'
                ]
            ],
            [
                'title' => 'Organic Sunscreen SPF 30',
                'description' => 'Broad-spectrum sunscreen with natural ingredients to protect your skin from harmful UV rays. Lightweight and non-greasy formula perfect for daily use.',
                'price' => 27.99,
                'category' => 'Sunscreen',
                'stock' => 55,
                'benefits' => 'Broad-spectrum protection, Non-greasy, Daily use',
                'ingredients' => 'Zinc Oxide, Titanium Dioxide, Aloe Vera, Green Tea, Vitamin E',
                'size' => '60ml',
                'featured' => false,
                'images' => [
                    '/images/products/sunscreen-1.jpg',
                    '/images/products/sunscreen-2.jpg'
                ]
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
