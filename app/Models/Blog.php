<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'excerpt',
        'content',
        'meta_description',
        'featured_image',
        'published_at',
        'sort_order',
        'is_active',
    ];

    public array $translatable = [
        'title',
        'excerpt',
        'content',
        'meta_description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
