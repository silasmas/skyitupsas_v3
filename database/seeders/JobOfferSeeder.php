<?php

namespace Database\Seeders;

use App\Models\JobOffer;
use Illuminate\Database\Seeder;

class JobOfferSeeder extends Seeder
{
    public function run(): void
    {
        $fr = require resource_path('lang/fr/info.php');
        $en = require resource_path('lang/en/info.php');
        $sFr = $fr['service'];
        $sEn = $en['service'];

        $offers = [
            [
                'slug' => 'consultant-transformation-digitale',
                'title' => ['fr' => 'Consultant transformation digitale', 'en' => 'Digital transformation consultant'],
                'description' => [
                    'fr' => '<p>'.e($sFr['content1']).'</p>',
                    'en' => '<p>'.e($sEn['content1']).'</p>',
                ],
                'requirements' => [
                    'fr' => '<p>'.e($sFr['title1_']).' — expérience terrain en RDC appréciée.</p>',
                    'en' => '<p>'.e($sEn['title1_']).' — field experience in the DRC is a plus.</p>',
                ],
                'location' => ['fr' => 'Kinshasa', 'en' => 'Kinshasa'],
                'contract_type' => 'cdi',
                'sort_order' => 1,
            ],
            [
                'slug' => 'ingenieur-solutions-logicielles',
                'title' => ['fr' => 'Ingénieur solutions logicielles', 'en' => 'Software solutions engineer'],
                'description' => [
                    'fr' => '<p>'.e($sFr['content2_1']).'</p>',
                    'en' => '<p>'.e($sEn['content2_1']).'</p>',
                ],
                'requirements' => [
                    'fr' => '<p>Maîtrise des cycles de développement et bonne culture client.</p>',
                    'en' => '<p>Solid grasp of delivery cycles and client-facing communication.</p>',
                ],
                'location' => ['fr' => 'Kinshasa / Lubumbashi', 'en' => 'Kinshasa / Lubumbashi'],
                'contract_type' => 'cdd',
                'sort_order' => 2,
            ],
            [
                'slug' => 'technicien-support-it',
                'title' => ['fr' => 'Technicien support & assistance IT', 'en' => 'IT support technician'],
                'description' => [
                    'fr' => '<p>'.e($sFr['content5_1']).'</p>',
                    'en' => '<p>'.e($sEn['content5_1']).'</p>',
                ],
                'requirements' => [
                    'fr' => '<p>Réactivité, sens du service, expérience postes de travail et réseau.</p>',
                    'en' => '<p>Customer mindset, responsiveness, desktop and network basics.</p>',
                ],
                'location' => ['fr' => 'Kinshasa', 'en' => 'Kinshasa'],
                'contract_type' => 'cdi',
                'sort_order' => 3,
            ],
        ];

        foreach ($offers as $o) {
            JobOffer::updateOrCreate(
                ['slug' => $o['slug']],
                array_merge($o, [
                    'published_at' => now()->subWeek(),
                    'closes_at' => now()->addMonths(2),
                    'is_active' => true,
                ])
            );
        }
    }
}
