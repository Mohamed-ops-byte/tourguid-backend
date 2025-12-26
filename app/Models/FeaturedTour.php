<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedTour extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        // إذا كانت الصورة رابط خارجي، أرجعها كما هي
        if ($this->image_path && (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://'))) {
            return $this->image_path;
        }
        // وإلا أرجع الرابط المحلي
        return $this->image_path ? url('storage/' . $this->image_path) : null;
    }
}
