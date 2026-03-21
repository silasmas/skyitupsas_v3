<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\HasTranslations;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
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
            'big_title' => $this->formatTranslatable('big_title', $withTranslations),
            'big_title_1' => $this->formatTranslatable('big_title_1', $withTranslations),
            'big_title_2' => $this->formatTranslatable('big_title_2', $withTranslations),
            'welcome_title_1' => $this->formatTranslatable('welcome_title_1', $withTranslations),
            'welcome_title_2' => $this->formatTranslatable('welcome_title_2', $withTranslations),
            'content' => $this->formatTranslatable('content', $withTranslations),
            'experience_label' => $this->formatTranslatable('experience_label', $withTranslations),
            'diploma_label' => $this->formatTranslatable('diploma_label', $withTranslations),
            'expertise_label' => $this->formatTranslatable('expertise_label', $withTranslations),
            'work_countries_label' => $this->formatTranslatable('work_countries_label', $withTranslations),
            'content1' => $this->formatTranslatable('content1', $withTranslations),
            'content2' => $this->formatTranslatable('content2', $withTranslations),
            'meta_description' => $this->formatTranslatable('meta_description', $withTranslations),
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'links' => [
                'delete' => route('api.abouts.destroy', $this->slug),
            ],
        ];
    }
}
