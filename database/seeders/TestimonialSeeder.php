<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

/**
 * Initialise les témoignages clients de départ (remplacent les placeholders front).
 */
class TestimonialSeeder extends Seeder
{
    /**
     * Insère les témoignages initiaux s'ils n'existent pas encore.
     */
    public function run(): void
    {
        $items = [
            [
                'slug' => 'directeur-operations',
                'quote' => [
                    'fr' => 'SkyITup nous a accompagnés sur la digitalisation de nos opérations. L\'équipe est rigoureuse, à l\'écoute, et livre exactement ce qui a été annoncé.',
                    'en' => 'SkyITup supported us in digitizing our operations. The team is rigorous, attentive, and delivers exactly what was promised.',
                ],
                'name' => [
                    'fr' => 'À compléter',
                    'en' => 'To be completed',
                ],
                'role' => [
                    'fr' => 'Directeur des opérations',
                    'en' => 'Operations Director',
                ],
                'company' => [
                    'fr' => 'Client à confirmer',
                    'en' => 'Client to confirm',
                ],
                'sort_order' => 1,
            ],
            [
                'slug' => 'responsable-programme-ong',
                'quote' => [
                    'fr' => 'Nous avons gagné en visibilité sur l\'ensemble de nos antennes terrain. La plateforme est utilisée tous les jours et nous fait gagner un temps considérable.',
                    'en' => 'We gained visibility across all our field offices. The platform is used every day and saves us considerable time.',
                ],
                'name' => [
                    'fr' => 'À compléter',
                    'en' => 'To be completed',
                ],
                'role' => [
                    'fr' => 'Responsable programme',
                    'en' => 'Program Manager',
                ],
                'company' => [
                    'fr' => 'ONG partenaire',
                    'en' => 'Partner NGO',
                ],
                'sort_order' => 2,
            ],
            [
                'slug' => 'daf-distribution',
                'quote' => [
                    'fr' => 'Le déploiement Odoo s\'est fait sans heurt. Plus important encore : nos équipes ont été formées et sont autonomes au quotidien.',
                    'en' => 'The Odoo rollout went smoothly. More importantly, our teams were trained and are autonomous day to day.',
                ],
                'name' => [
                    'fr' => 'À compléter',
                    'en' => 'To be completed',
                ],
                'role' => [
                    'fr' => 'DAF',
                    'en' => 'CFO',
                ],
                'company' => [
                    'fr' => 'Groupe distribution',
                    'en' => 'Retail group',
                ],
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $item) {
            Testimonial::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'quote' => $item['quote'],
                    'name' => $item['name'],
                    'role' => $item['role'],
                    'company' => $item['company'],
                    'sort_order' => $item['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
