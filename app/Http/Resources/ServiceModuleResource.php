<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\HasTranslations;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Sérialisation API d'un module de service.
 */
class ServiceModuleResource extends JsonResource
{
    use HasTranslations;

    /**
     * Transforme le module en tableau JSON.
     *
     * @param  Request  $request  Requête HTTP
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $withTranslations = $this->withTranslations($request);

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'pillar_slug' => $this->whenLoaded('pillar', fn () => $this->pillar?->slug),
            'pillar_id' => $this->service_pillar_id,
            'title' => $this->formatTranslatable('title', $withTranslations),
            'benefit_text' => $this->formatTranslatable('benefit_text', $withTranslations),
            'summary_text' => $this->formatTranslatable('summary_text', $withTranslations),
            'cta_label' => $this->formatTranslatable('cta_label', $withTranslations),
            'cta_delay' => $this->cta_delay,
            'meta_description' => $this->formatTranslatable('meta_description', $withTranslations),
            'icon' => $this->icon,
            'featured_image' => $this->imageUrl(),
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
        ];
    }
}
