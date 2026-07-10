<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\HasTranslations;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'address' => $this->formatTranslatable('address', $withTranslations),
            'meta_description' => $this->formatTranslatable('meta_description', $withTranslations),
            'email' => $this->email,
            'phone' => $this->phone,
            'map_embed' => $this->map_embed,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
