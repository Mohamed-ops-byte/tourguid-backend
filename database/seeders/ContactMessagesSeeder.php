<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactMessage;
use Illuminate\Support\Str;

class ContactMessagesSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'name' => 'John Carter',
                'email' => 'john@example.com',
                'phone' => '+12025550123',
                'tour_type' => 'Pyramids Tour',
                'message' => 'Hi, I would like to book a private tour for 2 people next weekend. Could you share availability and pricing?'
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily@example.com',
                'phone' => '+447700900123',
                'tour_type' => 'Nile Cruise',
                'message' => 'We are a family of 4 visiting in March. Is dinner included and do you offer hotel pickup?'
            ],
            [
                'name' => 'Marco Rossi',
                'email' => 'marco@example.com',
                'phone' => '+39061234567',
                'tour_type' => 'Desert Safari',
                'message' => 'Ciao! Vorremmo fare un safari nel deserto con quad bike. È possibile al tramonto?'
            ],
        ];

        foreach ($messages as $m) {
            ContactMessage::create($m);
        }
    }
}
