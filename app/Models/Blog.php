<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasFactory, HasTranslations;

    /** Type « article de blog ». */
    public const TYPE_BLOG = 'blog';

    /** Type « actualité / news ». */
    public const TYPE_NEWS = 'news';

    /**
     * Libellés des types disponibles, réutilisés par l'admin et la validation.
     *
     * @var array<string, string>
     */
    public const TYPES = [
        self::TYPE_BLOG => 'Blog',
        self::TYPE_NEWS => 'Actualité',
    ];

    protected $fillable = [
        'slug',
        'type',
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

    /**
     * Restreint la requête à un type donné (blog ou actualité).
     *
     * @param  Builder  $query  Requête Eloquent en cours
     * @param  string  $type  Type recherché (self::TYPE_BLOG|self::TYPE_NEWS)
     * @return Builder Requête filtrée par type
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}
