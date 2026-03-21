<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\HasTranslations;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TeamMemberResource extends JsonResource
{
    use HasTranslations;

    public function toArray(Request $request): array
    {
        $withTranslations = $this->withTranslations($request);
        $name = $this->formatTranslatable('name', $withTranslations);
        $nameValue = is_array($name) ? ($name['value'] ?? '') : $name;

        $pictureUrl = $this->picture && Storage::exists($this->picture)
            ? Storage::url($this->picture)
            : null;

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'picture' => $pictureUrl,
            'initials' => $this->getInitials($nameValue),
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'name' => $this->formatTranslatable('name', $withTranslations),
            'role' => $this->formatTranslatable('role', $withTranslations),
            'assets' => $this->formatTranslatable('assets', $withTranslations),
            'experience' => $this->formatTranslatable('experience', $withTranslations),
            'diplomas' => $this->formatTranslatable('diplomas', $withTranslations),
            'expertises' => $this->formatTranslatable('expertises', $withTranslations),
            'work_countries' => $this->formatTranslatable('work_countries', $withTranslations),
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'links' => [
                'delete' => route('api.team-members.destroy', $this->slug),
            ],
        ];
    }

    protected function getInitials(?string $name): string
    {
        if (blank($name)) {
            return '?';
        }

        $parts = array_filter(explode(' ', trim($name)));

        if (count($parts) >= 2) {
            return strtoupper(mb_substr($parts[0], 0, 1) . mb_substr($parts[array_key_last($parts)], 0, 1));
        }

        return strtoupper(mb_substr($name, 0, min(2, mb_strlen($name))));
    }
}
