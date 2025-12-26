<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Pyramids of Giza Tour',
                'icon' => '🗿',
                'description' => 'Guided tour to the Great Pyramids and the Sphinx with photo stops and historical insights.',
                'features' => ['Hotel pickup', 'Expert guide', 'Entrance tickets not included'],
                'price' => '80',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Museum of Egyptian Antiquities',
                'icon' => '🏛️',
                'description' => 'Explore the treasures of ancient Egypt including Tutankhamun’s collection.',
                'features' => ['Skip-the-line', 'Audio guide available', 'Flexible timing'],
                'price' => '50',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Nile Dinner Cruise',
                'icon' => '🛥️',
                'description' => 'Evening cruise with live entertainment and buffet dinner on the Nile.',
                'features' => ['Live music & Tanoura show', 'Dinner included', '2-hour cruise'],
                'price' => '65',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Desert Safari by Quad Bike',
                'icon' => '🏜️',
                'description' => 'Thrilling quad bike ride across the desert dunes with a Bedouin camp visit.',
                'features' => ['Safety briefing', 'Equipment provided', 'Sunset photo stop'],
                'price' => '70',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Old Cairo Walking Tour',
                'icon' => '🚶‍♂️',
                'description' => 'Discover Coptic Cairo, Khan El Khalili bazaar, and Islamic Cairo heritage.',
                'features' => ['Small groups', 'Customizable route', 'Coffee break'],
                'price' => '45',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($services as $s) {
            Service::create($s);
        }
    }
}
