<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TeamMember extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'picture',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'name',
        'role',
        'bio',
        'assets',
        'experience',
        'diplomas',
        'work_countries',
        'expertises',
        'sort_order',
        'is_active',
    ];

    public array $translatable = [
        'name',
        'role',
        'bio',
        'assets',
        'experience',
        'diplomas',
        'expertises',
        'work_countries',
    ];

    protected $casts = [
        'assets' => 'array',
        'experience' => 'array',
        'diplomas' => 'array',
        'expertises' => 'array',
        'work_countries' => 'array',
        'is_active' => 'boolean',
    ];
}
