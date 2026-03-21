<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Realisation extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'content',
        'meta_description',
        'featured_image',
        'client',
        'project_date',
        'project_url',
        'sort_order',
        'is_active',
    ];

    public array $translatable = [
        'title',
        'description',
        'content',
        'meta_description',
    ];

    protected $casts = [
        'project_date' => 'date',
        'is_active' => 'boolean',
    ];
}
