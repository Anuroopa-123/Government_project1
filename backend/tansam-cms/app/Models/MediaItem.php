<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $fillable = [
        'category',
        'image',
        'title',
        'is_published',
    ];

    public function getImageAttribute($value)
    {
        return url($value);
    }
}
