<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\HasTranslations;
use App\Http\Resources\Concerns\ResolvesMediaUrls;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    use HasTranslations;
    use ResolvesMediaUrls;

    public function toArray(Request $request): array
    {
        $withTranslations = $this->withTranslations($request);

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->formatTranslatable('name', $withTranslations),
            'logo' => $this->mediaUrl($this->logo),
            'website_url' => $this->website_url,
            'open_in_new_tab' => $this->open_in_new_tab,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
