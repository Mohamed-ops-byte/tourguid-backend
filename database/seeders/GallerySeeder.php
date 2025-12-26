<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use App\Models\GalleryItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Historical Sites', 'slug' => 'historical', 'order' => 1, 'is_active' => true],
            ['name' => 'City Life', 'slug' => 'city', 'order' => 2, 'is_active' => true],
            ['name' => 'Desert Adventures', 'slug' => 'desert', 'order' => 3, 'is_active' => true],
            ['name' => 'Nile & Water', 'slug' => 'nile', 'order' => 4, 'is_active' => true],
            ['name' => 'Food & Culture', 'slug' => 'food', 'order' => 5, 'is_active' => true],
        ];

        $categoryIds = [];
        foreach ($categories as $cat) {
            $category = GalleryCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
            $categoryIds[$cat['slug']] = $category->id;
        }

        // Image sources (Unsplash) - safe to hotlink for development; but we download to storage
        $images = [
            // Historical
            ['slug' => 'historical', 'title' => 'Giza Pyramids', 'url' => 'https://images.unsplash.com/photo-1577720643272-265f434f6e73?w=1200&q=80'],
            ['slug' => 'historical', 'title' => 'Luxor Temple', 'url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&q=80'],
            ['slug' => 'historical', 'title' => 'Karnak Columns', 'url' => 'https://images.unsplash.com/photo-1560264418-a9a6b36aa1fb?w=1200&q=80'],
            ['slug' => 'historical', 'title' => 'Abu Simbel', 'url' => 'https://images.unsplash.com/photo-1533656279178-7a1b2b456c1e?w=1200&q=80'],

            // City
            ['slug' => 'city', 'title' => 'Cairo Skyline', 'url' => 'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=1200&q=80'],
            ['slug' => 'city', 'title' => 'Old Streets', 'url' => 'https://images.unsplash.com/photo-1521295121783-8a321d551ad2?w=1200&q=80'],
            ['slug' => 'city', 'title' => 'Khan El Khalili', 'url' => 'https://images.unsplash.com/photo-1564547080140-3df8c8f1f31a?w=1200&q=80'],
            ['slug' => 'city', 'title' => 'Cairo Night Lights', 'url' => 'https://images.unsplash.com/photo-1505761671935-60b3a7427bad?w=1200&q=80'],

            // Nile
            ['slug' => 'nile', 'title' => 'Nile Sunset', 'url' => 'https://images.unsplash.com/photo-1505142468610-359e7d316be0?w=1200&q=80'],
            ['slug' => 'nile', 'title' => 'Felucca Boats', 'url' => 'https://images.unsplash.com/photo-1454873355991-c0612d2ab6f0?w=1200&q=80'],
            ['slug' => 'nile', 'title' => 'Corniche View', 'url' => 'https://images.unsplash.com/photo-1519685679731-1ffec3c8756f?w=1200&q=80'],

            // Desert
            ['slug' => 'desert', 'title' => 'Desert Dunes', 'url' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1200&q=80'],
            ['slug' => 'desert', 'title' => 'Camel Caravan', 'url' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1200&q=80'],
            ['slug' => 'desert', 'title' => 'Sunset Safari', 'url' => 'https://images.unsplash.com/photo-1496024840928-4b99f0b6f87b?w=1200&q=80'],

            // Food & Culture
            ['slug' => 'food', 'title' => 'Local Market', 'url' => 'https://images.unsplash.com/photo-1488661558014-ce1d14e48c17?w=1200&q=80'],
            ['slug' => 'food', 'title' => 'Egyptian Cuisine', 'url' => 'https://images.unsplash.com/photo-1604908554049-1be1021552d0?w=1200&q=80'],
            ['slug' => 'food', 'title' => 'Spices & Colors', 'url' => 'https://images.unsplash.com/photo-1469536526925-999cf4ad3b87?w=1200&q=80'],
        ];

        foreach ($images as $img) {
            $categoryId = $categoryIds[$img['slug']] ?? null;
            if (!$categoryId) continue;

            // Download image & store under public disk
            $response = Http::withoutVerifying()->get($img['url']);
            if ($response->successful()) {
                $ext = 'jpg';
                $filename = 'gallery/' . $img['slug'] . '/' . Str::random(20) . '.' . $ext;
                Storage::disk('public')->put($filename, $response->body());

                GalleryItem::create([
                    'gallery_category_id' => $categoryId,
                    'title' => $img['title'],
                    'description' => $img['title'] . ' in ' . ucfirst($img['slug']),
                    'image_path' => $filename,
                    'order' => 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
