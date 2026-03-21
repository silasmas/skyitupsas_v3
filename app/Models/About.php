<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'big_title',
        'big_title_1',
        'big_title_2',
        'welcome_title_1',
        'welcome_title_2',
        'content',
        'experience_label',
        'diploma_label',
        'expertise_label',
        'work_countries_label',
        'content1',
        'content2',
        'meta_description',
        'sort_order',
        'is_active',
    ];

    public array $translatable = [
        'title',
        'subtitle',
        'big_title',
        'big_title_1',
        'big_title_2',
        'welcome_title_1',
        'welcome_title_2',
        'content',
        'experience_label',
        'diploma_label',
        'expertise_label',
        'work_countries_label',
        'content1',
        'content2',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
