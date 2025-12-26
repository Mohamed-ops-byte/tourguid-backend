<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Base user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Core content
        $this->call([
            OwnerInfoSeeder::class,
            ServicesSeeder::class,
            GallerySeeder::class,
            VideosSeeder::class,
            FeaturedTourSeeder::class,
            ContactMessagesSeeder::class,
        ]);
    }
}
