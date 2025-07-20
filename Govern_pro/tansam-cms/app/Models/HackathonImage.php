<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HackathonImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hackathon_id',
        'image_path',
    ];

    public function hackathon()
    {
        return $this->belongsTo(Hackathon::class);
    }

    public function getImagePathAttribute($value)
    {
        return url($value);
    }
}
