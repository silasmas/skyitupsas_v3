<?php

namespace Database\Seeders;

use App\Models\Realisation;
use Illuminate\Database\Seeder;

/**
 * Contenus alignés sur l’ancienne page « Réalisations » (skyitupsas.com/realization).
 */
class RealisationSeeder extends Seeder
{
    public function run(): void
    {
        Realisation::query()->whereIn('slug', [
            'conseil-transformation-digitale',
            'deploiement-solutions-logicielles',
            'infrastructure-informatique',
            'support-assistance-utilisateurs',
        ])->delete();

        $loremFr = 'Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.';
        $loremEn = 'Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.';

        $items = [
            [
                'slug' => 'conseil-congolais-de-la-batterie',
                'title' => [
                    'fr' => 'Conseil Congolais de la batterie',
                    'en' => 'Congolese Battery Council',
                ],
                'description' => [
                    'fr' => $loremFr,
                    'en' => $loremEn,
                ],
                'featured_image' => 'realizations/realization-01.png',
                'client' => 'Conseil Congolais de la batterie',
                'sort_order' => 1,
            ],
            [
                'slug' => 'fond-de-promotion-culturelle',
                'title' => [
                    'fr' => 'Fond de promotion culturelle',
                    'en' => 'Cultural promotion fund',
                ],
                'description' => [
                    'fr' => $loremFr,
                    'en' => $loremEn,
                ],
                'featured_image' => 'realizations/realization-02.png',
                'client' => 'Fond de promotion culturelle',
                'sort_order' => 2,
            ],
            [
                'slug' => 'mdfils-sarl',
                'title' => [
                    'fr' => 'Mdfils SARL',
                    'en' => 'Mdfils SARL',
                ],
                'description' => [
                    'fr' => $loremFr,
                    'en' => $loremEn,
                ],
                'featured_image' => 'realizations/realization-03.jpeg',
                'client' => 'Mdfils SARL',
                'sort_order' => 3,
            ],
            [
                'slug' => 'sca-inter-a-sante-rdc',
                'title' => [
                    'fr' => 'SCA INTER A Santé — RDC',
                    'en' => 'SCA INTER A Santé — DRC',
                ],
                'description' => [
                    'fr' => $loremFr,
                    'en' => $loremEn,
                ],
                'featured_image' => 'realizations/realization-04.jpg',
                'client' => 'SCA INTER A Santé',
                'sort_order' => 4,
            ],
            [
                'slug' => 'caisse-nationale-de-securite-sociale',
                'title' => [
                    'fr' => 'Caisse Nationale de Sécurité Sociale',
                    'en' => 'National Social Security Fund',
                ],
                'description' => [
                    'fr' => $loremFr,
                    'en' => $loremEn,
                ],
                'featured_image' => 'realizations/realization-01.png',
                'client' => 'CNSS',
                'sort_order' => 5,
            ],
        ];

        foreach ($items as $row) {
            $img = $row['featured_image'];
            if (! file_exists(public_path('assets/img/'.$img))) {
                $img = null;
            }
            Realisation::updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'content' => [
                        'fr' => '<p>'.$row['description']['fr'].'</p>',
                        'en' => '<p>'.$row['description']['en'].'</p>',
                    ],
                    'meta_description' => $row['description'],
                    'featured_image' => $img,
                    'client' => $row['client'],
                    'project_date' => now()->subMonths(6)->startOfMonth(),
                    'project_url' => null,
                    'sort_order' => $row['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
