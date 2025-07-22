<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $fillable = ['video', 'is_published'];

    public function getImageAttribute($value)
    {
        return url($value);
    }
}
