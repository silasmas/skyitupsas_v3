<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeamMemberSeeder extends Seeder
{
    /**
     * Données alignées sur l’ancien site skyitupsas.com (équipe / leadership).
     */
    public function run(): void
    {
        $path = public_path('js/team.json');

        if (file_exists($path)) {
            $this->seedFromJson($path);

            return;
        }

        $defaults = [
            [
                'slug' => 'alphonse-willy-ngana-mabiala',
                'picture' => 'team/member-1.jpg',
                'name' => [
                    'fr' => 'Alphonse-Willy Ngana Mabiala',
                    'en' => 'Alphonse-Willy Ngana Mabiala',
                ],
                'role' => [
                    'fr' => 'Cofondateur & Directeur général',
                    'en' => 'Co-founder & Chief Executive Officer',
                ],
                'bio' => [
                    'fr' => 'Cofondateur de SkyITup, il pilote la vision stratégique et le développement de l’entreprise au service des clients en RDC.',
                    'en' => 'SkyITup co-founder; he leads strategic vision and company growth for clients across the DRC.',
                ],
            ],
            [
                'slug' => 'rene-kungana-kola',
                'picture' => 'team/member-2.jpg',
                'name' => [
                    'fr' => 'René Kungana Kola',
                    'en' => 'René Kungana Kola',
                ],
                'role' => [
                    'fr' => 'Directeur de transformation digitale',
                    'en' => 'Head of digital transformation',
                ],
                'bio' => [
                    'fr' => 'Il conduit les programmes de transformation numérique et l’alignement des solutions sur les objectifs métiers.',
                    'en' => 'He leads digital transformation programmes and aligns solutions with business goals.',
                ],
            ],
            [
                'slug' => 'luminuku-kiasingama-emile',
                'picture' => 'team/member-3.jpg',
                'name' => [
                    'fr' => 'Luminuku Kiasingama Emile',
                    'en' => 'Luminuku Kiasingama Emile',
                ],
                'role' => [
                    'fr' => 'Directeur régional Grand Katanga',
                    'en' => 'Regional director — Greater Katanga',
                ],
                'bio' => [
                    'fr' => 'Rattaché à la présence provinciale, il coordonne les interventions terrain et la relation client dans le Grand Katanga.',
                    'en' => 'Based in the provincial footprint, he coordinates field delivery and client relationships in Greater Katanga.',
                ],
            ],
            [
                'slug' => 'sarah-kalala',
                'picture' => 'team/member-4.jpg',
                'name' => [
                    'fr' => 'Sarah Kalala',
                    'en' => 'Sarah Kalala',
                ],
                'role' => [
                    'fr' => 'Marketing & communication',
                    'en' => 'Marketing & communications',
                ],
                'bio' => [
                    'fr' => 'Elle porte l’image de la marque, les contenus et la communication auprès des partenaires et du public.',
                    'en' => 'She drives brand, content, and communications with partners and the public.',
                ],
            ],
        ];

        foreach ($defaults as $index => $member) {
            $pic = $member['picture'];
            if (! file_exists(public_path('assets/img/'.$pic))) {
                $pic = null;
            }
            TeamMember::updateOrCreate(
                ['slug' => $member['slug']],
                [
                    'picture' => $pic,
                    'facebook' => null,
                    'twitter' => null,
                    'instagram' => null,
                    'linkedin' => null,
                    'name' => $member['name'],
                    'role' => $member['role'],
                    'bio' => $member['bio'] ?? ['fr' => '', 'en' => ''],
                    'assets' => ['fr' => [], 'en' => []],
                    'experience' => ['fr' => [], 'en' => []],
                    'diplomas' => ['fr' => [], 'en' => []],
                    'expertises' => ['fr' => [], 'en' => []],
                    'work_countries' => ['fr' => [], 'en' => []],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }

    private function seedFromJson(string $path): void
    {
        $data = json_decode(file_get_contents($path), true);
        $frMembers = $data['fr'] ?? [];
        $enMembers = $data['en'] ?? [];

        foreach ($frMembers as $index => $frMember) {
            $enMember = $enMembers[$index] ?? $frMember;
            $slug = Str::slug($frMember['names'] ?? 'member-'.($index + 1));

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
                    'bio' => [
                        'fr' => $frMember['bio'] ?? '',
                        'en' => $enMember['bio'] ?? $frMember['bio'] ?? '',
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
