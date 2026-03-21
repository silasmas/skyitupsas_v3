<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Contact extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'address',
        'meta_description',
        'email',
        'phone',
        'map_embed',
        'sort_order',
        'is_active',
    ];

    public array $translatable = [
        'title',
        'description',
        'address',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
