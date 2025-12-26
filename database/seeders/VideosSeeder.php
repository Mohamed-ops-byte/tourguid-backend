<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideosSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            [
                'title' => 'Discover Cairo - Highlights',
                'description' => 'A quick look at the top attractions in Cairo.',
                'url' => 'https://www.youtube.com/watch?v=jTL_sJycQAA',
                'platform' => 'youtube',
                'duration' => '04:12',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Nile Cruise Experience',
                'description' => 'Evening cruise along the Nile with stunning views.',
                'url' => 'https://www.youtube.com/watch?v=0h8I8p0msWI',
                'platform' => 'youtube',
                'duration' => '03:45',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'The Great Pyramids',
                'description' => 'Aerial views and historical facts about the Pyramids of Giza.',
                'url' => 'https://www.youtube.com/watch?v=FbemVRN03OI',
                'platform' => 'youtube',
                'duration' => '05:20',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($videos as $v) {
            Video::create($v);
        }
    }
}
