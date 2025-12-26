<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerInfo extends Model
{
    protected $table = 'owner_info';

    protected $fillable = [
        'name',
        'title',
        'bio_ar',
        'bio_en',
        'image_url',
        'years_experience',
        'tours_completed',
        'happy_clients',
        'average_rating',
    ];

    protected $casts = [
        'years_experience' => 'integer',
        'tours_completed' => 'integer',
        'happy_clients' => 'integer',
        'average_rating' => 'decimal:1',
    ];
}
