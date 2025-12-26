<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OwnerInfo;

class OwnerInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OwnerInfo::create([
            'name' => 'Mohamed Khalel',
            'title' => 'Professional Tourist Guide',
            'bio_ar' => 'مرحبا! أنا محمد، دليل سياحي معتمد ومتحمس مع أكثر من 10 سنوات من الخبرة في عرض جمال وتاريخ وثقافة منطقتنا الرائعة.',
            'bio_en' => 'Hello! I\'m Mohamed, a passionate and certified tourist guide with over 10 years of experience showcasing the beauty, history, and culture of our incredible region.',
            'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800',
            'years_experience' => 10,
            'tours_completed' => 500,
            'happy_clients' => 1200,
            'average_rating' => 4.9,
        ]);
    }
}
