<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'slider_image',
        'slider_title',
        'is_published',
    ];

    public function getSliderImageAttribute($value)
    {
        return url($value);
    }
}
