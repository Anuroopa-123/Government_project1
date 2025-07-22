<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
     protected $fillable = [
        'name',
        'description',
        'image',
        'role',
    ];
    
    public function getImageAttribute($value)
    {
        return $value ? url($value) : null;
    }
}
