<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Témoignage client affiché sur le site public.
 */
class Testimonial extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'quote',
        'name',
        'role',
        'company',
        'photo',
        'sort_order',
        'is_active',
    ];

    public array $translatable = [
        'quote',
        'name',
        'role',
        'company',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Ne conserve que les témoignages actifs.
     *
     * @param  Builder  $query  Requête Eloquent
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Trie les témoignages pour l'affichage public.
     *
     * @param  Builder  $query  Requête Eloquent
     * @return Builder
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
