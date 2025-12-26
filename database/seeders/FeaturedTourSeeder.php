<?php

namespace Database\Seeders;

use App\Models\FeaturedTour;
use Illuminate\Database\Seeder;

class FeaturedTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FeaturedTour::create([
            'title' => 'Pyramids Tour',
            'description' => 'Explore the magnificent Pyramids of Giza with expert commentary',
            'image_path' => 'https://images.unsplash.com/photo-1577720643272-265f434f6e73?w=800&h=600&fit=crop',
            'order' => 1,
            'is_active' => true
        ]);

        FeaturedTour::create([
            'title' => 'Nile Cruise',
            'description' => 'Experience the beauty of the Nile River on a luxury cruise',
            'image_path' => 'https://images.unsplash.com/photo-1505142468610-359e7d316be0?w=800&h=600&fit=crop',
            'order' => 2,
            'is_active' => true
        ]);

        FeaturedTour::create([
            'title' => 'Desert Safari',
            'description' => 'Thrilling desert adventure in the Egyptian Sahara',
            'image_path' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=800&h=600&fit=crop',
            'order' => 3,
            'is_active' => true
        ]);

        FeaturedTour::create([
            'title' => 'Temple Tour',
            'description' => 'Discover ancient Egyptian temples and their incredible history',
            'image_path' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop',
            'order' => 4,
            'is_active' => true
        ]);

        FeaturedTour::create([
            'title' => 'Market Experience',
            'description' => 'Immerse yourself in the vibrant atmosphere of local markets',
            'image_path' => 'https://images.unsplash.com/photo-1488661558014-ce1d14e48c17?w=800&h=600&fit=crop',
            'order' => 5,
            'is_active' => true
        ]);

        FeaturedTour::create([
            'title' => 'City Walking Tour',
            'description' => 'Explore the modern and historic streets of Cairo',
            'image_path' => 'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=800&h=600&fit=crop',
            'order' => 6,
            'is_active' => true
        ]);
    }
}
