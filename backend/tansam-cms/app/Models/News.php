<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'news_image',
        'description',
        'date',
        'role',
        'is_published',
    ];

    public function getNewsImageAttribute($value)
    {
        return url($value);
    }
}
