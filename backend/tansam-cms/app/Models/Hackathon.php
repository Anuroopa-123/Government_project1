<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hackathon extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'image',
        'is_published',
    ];

    public function showcaseImages()
    {
        return $this->hasMany(HackathonImage::class,'hackathon_id','id');
    }

    public function getImageAttribute($value)
    {
        return url($value);
    }
}
