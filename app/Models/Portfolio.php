<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_SAVED = 'saved';

    protected $fillable = [
        'user_id',
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
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}