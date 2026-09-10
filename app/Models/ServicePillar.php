<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
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
     * URL publique de l'image du pilier (assets/img ou storage public).
     *
     * @return string|null URL absolue ou null
     */
    public function imageUrl(): ?string
    {
        return $this->resolveImageUrl($this->featured_image);
    }

    /**
     * Résout une URL d'image depuis le chemin stocké en base.
     *
     * @param  string|null  $path  Chemin relatif
     * @return string|null URL absolue ou null
     */
    protected function resolveImageUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (file_exists(public_path('assets/img/'.$path))) {
            return asset('assets/img/'.$path);
        }

        if (Storage::disk('public')->exists($path)) {
            return url(Storage::disk('public')->url($path));
        }

        return null;
    }
}
