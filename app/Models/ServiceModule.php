<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/**
 * Module de service rattaché à un pilier stratégique.
 */
class ServiceModule extends Model
{
    use HasTranslations;

    /** @var list<string> */
    protected $fillable = [
        'service_pillar_id',
        'slug',
        'title',
        'benefit_text',
        'summary_text',
        'cta_label',
        'cta_delay',
        'meta_description',
        'icon',
        'featured_image',
        'sort_order',
        'is_active',
    ];

    /** @var list<string> */
    public array $translatable = [
        'title',
        'benefit_text',
        'summary_text',
        'cta_label',
        'meta_description',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Pilier parent du module.
     *
     * @return BelongsTo<ServicePillar, ServiceModule>
     */
    public function pillar(): BelongsTo
    {
        return $this->belongsTo(ServicePillar::class, 'service_pillar_id');
    }

    /**
     * URL publique de l'image du module.
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
