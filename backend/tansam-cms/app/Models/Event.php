<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'image',
        'category',
        'is_published'
    ];

    public function getImageAttribute($value)
    {
        return url($value);
    }
}
