<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\HasTranslations;
use App\Http\Resources\Concerns\ResolvesMediaUrls;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Sérialise un témoignage client pour l'API headless.
 */
class TestimonialResource extends JsonResource
{
    use HasTranslations;
    use ResolvesMediaUrls;

    /**
     * Transforme la ressource en tableau JSON.
     *
     * @param  Request  $request  Requête HTTP courante
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $withTranslations = $this->withTranslations($request);

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'quote' => $this->formatTranslatable('quote', $withTranslations),
            'name' => $this->formatTranslatable('name', $withTranslations),
            'role' => $this->formatTranslatable('role', $withTranslations),
            'company' => $this->formatTranslatable('company', $withTranslations),
            'photo' => $this->mediaUrl($this->photo),
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
