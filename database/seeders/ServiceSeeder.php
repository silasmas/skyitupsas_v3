<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $fr = require resource_path('lang/fr/info.php');
        $en = require resource_path('lang/en/info.php');
        $serviceFr = $fr['service'];
        $serviceEn = $en['service'];

        $services = [
            [
                'slug' => 'service-consulting',
                'title' => ['fr' => $serviceFr['title1'], 'en' => $serviceEn['title1']],
                'subtitle' => ['fr' => $serviceFr['title1_'], 'en' => $serviceEn['title1_']],
                'description' => ['fr' => $serviceFr['content1'], 'en' => $serviceEn['content1']],
                'content' => [
                    'fr' => [
                        'content1' => $serviceFr['content1'],
                        'content1_1' => $serviceFr['content1_1'],
                        'content1_2' => $serviceFr['content1_2'],
                        'content1_3' => $serviceFr['content1_3'],
                    ],
                    'en' => [
                        'content1' => $serviceEn['content1'],
                        'content1_1' => $serviceEn['content1_1'],
                        'content1_2' => $serviceEn['content1_2'],
                        'content1_3' => $serviceEn['content1_3'],
                    ],
                ],
                'sort_order' => 1,
            ],
            [
                'slug' => 'solutions-numeriques-logiciels',
                'title' => ['fr' => $serviceFr['title2'], 'en' => $serviceEn['title2']],
                'subtitle' => ['fr' => '', 'en' => ''],
                'description' => ['fr' => $serviceFr['content2_1'], 'en' => $serviceEn['content2_1']],
                'content' => [
                    'fr' => [
                        'content2_1' => $serviceFr['content2_1'],
                        'content2_2' => $serviceFr['content2_2'],
                        'content2_3' => $serviceFr['content2_3'],
                    ],
                    'en' => [
                        'content2_1' => $serviceEn['content2_1'],
                        'content2_2' => $serviceEn['content2_2'],
                        'content2_3' => $serviceEn['content2_3'],
                    ],
                ],
                'sort_order' => 2,
            ],
            [
                'slug' => 'infrastructure-informatique',
                'title' => ['fr' => $serviceFr['title3'], 'en' => $serviceEn['title3']],
                'subtitle' => ['fr' => '', 'en' => ''],
                'description' => ['fr' => $serviceFr['content3_1']['content1'] ?? '', 'en' => $serviceEn['content3_1']['content1'] ?? ''],
                'content' => [
                    'fr' => $serviceFr['content3_1'],
                    'en' => $serviceEn['content3_1'],
                ],
                'sort_order' => 3,
            ],
            [
                'slug' => 'formation-transformation-digitale',
                'title' => ['fr' => $serviceFr['title4'], 'en' => $serviceEn['title4']],
                'subtitle' => ['fr' => '', 'en' => ''],
                'description' => ['fr' => $serviceFr['content4']['text'] ?? '', 'en' => $serviceEn['content4']['text'] ?? ''],
                'content' => [
                    'fr' => $serviceFr['content4'],
                    'en' => $serviceEn['content4'],
                ],
                'sort_order' => 4,
            ],
            [
                'slug' => 'service-assistance',
                'title' => ['fr' => $serviceFr['title5'], 'en' => $serviceEn['title5']],
                'subtitle' => ['fr' => $serviceFr['inner_title5'], 'en' => $serviceEn['inner_title5']],
                'description' => ['fr' => $serviceFr['content5_1'], 'en' => $serviceEn['content5_1']],
                'content' => [
                    'fr' => [
                        'content5_1' => $serviceFr['content5_1'],
                        'content5_2' => $serviceFr['content5_2'],
                        'content5_3' => $serviceFr['content5_3'],
                    ],
                    'en' => [
                        'content5_1' => $serviceEn['content5_1'],
                        'content5_2' => $serviceEn['content5_2'],
                        'content5_3' => $serviceEn['content5_3'],
                    ],
                ],
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                array_merge($service, [
                    'meta_description' => $service['description'],
                    'icon' => 'heroicon-o-cog-6-tooth',
                    'is_active' => true,
                ])
            );
        }
    }
}
