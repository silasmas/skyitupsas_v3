<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $path = public_path('js/team.json');

        if (! file_exists($path)) {
            TeamMember::factory(4)->create();
            return;
        }

        $data = json_decode(file_get_contents($path), true);
        $frMembers = $data['fr'] ?? [];
        $enMembers = $data['en'] ?? [];

        foreach ($frMembers as $index => $frMember) {
            $enMember = $enMembers[$index] ?? $frMember;
            $slug = Str::slug($frMember['names'] ?? 'member-' . ($index + 1));

            TeamMember::updateOrCreate(
                ['slug' => $slug],
                [
                'slug' => $slug,
                'picture' => $frMember['picture'] ?? $enMember['picture'] ?? null,
                'facebook' => $frMember['facebook'] ?: null,
                'twitter' => $frMember['twitter'] ?: null,
                'instagram' => $frMember['instagram'] ?: null,
                'linkedin' => $frMember['linkedin'] ?: null,
                'name' => [
                    'fr' => $frMember['names'] ?? '',
                    'en' => $enMember['names'] ?? $frMember['names'] ?? '',
                ],
                'role' => [
                    'fr' => $frMember['role'] ?? '',
                    'en' => $enMember['role'] ?? $frMember['role'] ?? '',
                ],
                'assets' => [
                    'fr' => $frMember['assets'] ?? [],
                    'en' => $enMember['assets'] ?? $frMember['assets'] ?? [],
                ],
                'experience' => [
                    'fr' => $frMember['experience'] ?? [],
                    'en' => $enMember['experience'] ?? $frMember['experience'] ?? [],
                ],
                'diplomas' => [
                    'fr' => $frMember['diplomas'] ?? [],
                    'en' => $enMember['diplomas'] ?? $frMember['diplomas'] ?? [],
                ],
                'expertises' => [
                    'fr' => $frMember['expertises'] ?? [],
                    'en' => $enMember['expertises'] ?? $frMember['expertises'] ?? [],
                ],
                'work_countries' => [
                    'fr' => $frMember['work_countries'] ?? [],
                    'en' => $enMember['work_countries'] ?? $frMember['work_countries'] ?? [],
                ],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]
            );
        }
    }
}
