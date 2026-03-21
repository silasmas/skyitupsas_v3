<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\HasTranslations;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    use HasTranslations;

    public function toArray(Request $request): array
    {
        $withTranslations = $this->withTranslations($request);

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->formatTranslatable('title', $withTranslations),
            'subtitle' => $this->formatTranslatable('subtitle', $withTranslations),
            'description' => $this->formatTranslatable('description', $withTranslations),
            'content' => $this->formatTranslatable('content', $withTranslations),
            'meta_description' => $this->formatTranslatable('meta_description', $withTranslations),
            'icon' => $this->icon,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'links' => [
                'delete' => route('api.services.destroy', $this->slug),
            ],
        ];
    }
}
