<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
   protected $fillable = [
        'main_title',
        'main_description',
        'why_choose_title',
        'why_choose_description',
        'features',
        'main_image',
        'secondary_image'
    ];

    protected $casts = [
        'features' => 'array' // Auto-convert JSON to array
    ];
}
