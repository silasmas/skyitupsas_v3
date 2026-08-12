<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * Pilier stratégique regroupant plusieurs modules de services.
 */
class ServicePillar extends Model
{
    use HasTranslations;

    /** @var list<string> */
    protected $fillable = [
        'slug',
        'title',
        'tagline',
        'client_challenge',
        'offer_summary',
        'differentiator',
        'meta_description',
        'icon',
        'featured_image',
        'sort_order',
        'is_active',
    ];

    /** @var list<string> */
    public array $translatable = [
        'title',
        'tagline',
        'client_challenge',
        'offer_summary',
        'differentiator',
        'meta_description',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Modules rattachés à ce pilier.
     *
     * @return HasMany<ServiceModule>
     */
    public function modules(): HasMany
    {
        return $this->hasMany(ServiceModule::class)->orderBy('sort_order');
    }

    /**
     * Modules actifs triés.
     *
     * @return HasMany<ServiceModule>
     */
    public function activeModules(): HasMany
    {
        return $this->modules()->where('is_active', true);
    }

    /**
     * URL publique de l'image du pilier.
     *
     * @return string|null URL absolue ou null
     */
    public function imageUrl(): ?string
    {
        if (! $this->featured_image) {
            return null;
        }

        $path = public_path('assets/img/'.$this->featured_image);
        if (file_exists($path)) {
            return asset('assets/img/'.$this->featured_image);
        }

        return null;
    }
}
