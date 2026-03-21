<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'description',
        'content',
        'meta_description',
        'icon',
        'sort_order',
        'is_active',
    ];

    public array $translatable = [
        'title',
        'subtitle',
        'description',
        'content',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
