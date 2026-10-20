<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

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
        'slug',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Builds a public link name like "juan-dela-cruz-x7k2pq".
    public static function makeSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'portfolio';

        do {
            $slug = $base . '-' . Str::lower(Str::random(6));
        } while (static::where('slug', $slug)->exists());

        return $slug;
    }
}