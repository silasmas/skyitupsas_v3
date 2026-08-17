<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\HasTranslations;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Sérialisation API d'un pilier de services (avec modules optionnels).
 */
class ServicePillarResource extends JsonResource
{
    use HasTranslations;

    /**
     * Transforme le pilier en tableau JSON.
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
            'title' => $this->formatTranslatable('title', $withTranslations),
            'tagline' => $this->formatTranslatable('tagline', $withTranslations),
            'client_challenge' => $this->formatTranslatable('client_challenge', $withTranslations),
            'offer_summary' => $this->formatTranslatable('offer_summary', $withTranslations),
            'differentiator' => $this->formatTranslatable('differentiator', $withTranslations),
            'meta_description' => $this->formatTranslatable('meta_description', $withTranslations),
            'icon' => $this->icon,
            'featured_image' => $this->imageUrl(),
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'modules' => ServiceModuleResource::collection($this->whenLoaded('modules')),
        ];
    }
}
