<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
         'name', 
         'position',
         'bio',
         'image_path',
         'social_instagram',
         'social_facebook',
         'order'
    ];
}
