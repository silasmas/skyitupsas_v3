<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\HasTranslations;
use App\Http\Resources\Concerns\ResolvesMediaUrls;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    use HasTranslations;
    use ResolvesMediaUrls;

    public function toArray(Request $request): array
    {
        $withTranslations = $this->withTranslations($request);

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->formatTranslatable('title', $withTranslations),
            'excerpt' => $this->formatTranslatable('excerpt', $withTranslations),
            'content' => $this->formatTranslatable('content', $withTranslations),
            'meta_description' => $this->formatTranslatable('meta_description', $withTranslations),
            'featured_image' => $this->mediaUrl($this->featured_image),
            'published_at' => $this->published_at?->toISOString(),
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
