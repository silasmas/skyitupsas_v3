<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\HasTranslations;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobOfferResource extends JsonResource
{
    use HasTranslations;

    public function toArray(Request $request): array
    {
        $withTranslations = $this->withTranslations($request);

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->formatTranslatable('title', $withTranslations),
            'description' => $this->formatTranslatable('description', $withTranslations),
            'requirements' => $this->formatTranslatable('requirements', $withTranslations),
            'location' => $this->formatTranslatable('location', $withTranslations),
            'contract_type' => $this->contract_type,
            'published_at' => $this->published_at?->toISOString(),
            'closes_at' => $this->closes_at?->toISOString(),
            'is_open' => $this->isOpenForApplications(),
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
