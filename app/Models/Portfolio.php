<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'full_name',
        'profile_picture',
        'email',
        'contact_number',
        'address',
        'about_me',
        'education',
        'skills',
        'projects',
        'work_experience',
        'social_links',
        'selected_template',
    ];
}
