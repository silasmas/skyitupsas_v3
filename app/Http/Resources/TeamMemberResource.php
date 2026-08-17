<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\HasTranslations;
use App\Http\Resources\Concerns\ResolvesMediaUrls;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamMemberResource extends JsonResource
{
    use HasTranslations;
    use ResolvesMediaUrls;

    public function toArray(Request $request): array
    {
        $withTranslations = $this->withTranslations($request);
        $name = $this->formatTranslatable('name', $withTranslations);
        $nameValue = is_array($name) ? ($name['value'] ?? '') : $name;

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'picture' => $this->mediaUrl($this->picture),
            'initials' => $this->getInitials($nameValue),
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'name' => $name,
            'role' => $this->formatTranslatable('role', $withTranslations),
            'bio' => $this->formatTranslatable('bio', $withTranslations),
            'assets' => $this->formatTranslatable('assets', $withTranslations),
            'experience' => $this->formatTranslatable('experience', $withTranslations),
            'diplomas' => $this->formatTranslatable('diplomas', $withTranslations),
            'expertises' => $this->formatTranslatable('expertises', $withTranslations),
            'work_countries' => $this->formatTranslatable('work_countries', $withTranslations),
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }

    /**
     * Construit les initiales à partir d'un nom complet.
     *
     * @param  string|null  $name  Nom complet du membre
     * @return string Initiales en majuscules (ou "?" si vide)
     */
    protected function getInitials(?string $name): string
    {
        if (blank($name)) {
            return '?';
        }

        $parts = array_filter(explode(' ', trim($name)));

        if (count($parts) >= 2) {
            return strtoupper(mb_substr($parts[0], 0, 1).mb_substr($parts[array_key_last($parts)], 0, 1));
        }

        return strtoupper(mb_substr($name, 0, min(2, mb_strlen($name))));
    }
}
