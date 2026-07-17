<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Insère quelques actualités de démonstration (type « news »).
     *
     * Utilise updateOrCreate sur le slug pour rester idempotent : relancer
     * le seeder met à jour les enregistrements existants sans créer de doublon.
     */
    public function run(): void
    {
        foreach ($this->newsItems() as $index => $item) {
            Blog::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'type' => Blog::TYPE_NEWS,
                    'title' => $item['title'],
                    'excerpt' => $item['excerpt'],
                    'content' => $item['content'],
                    'meta_description' => $item['excerpt'],
                    'featured_image' => $item['featured_image'],
                    'published_at' => Carbon::now()->subDays($index * 7),
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }
    }

    /**
     * Données des actualités de démonstration (contenu bilingue fr/en).
     *
     * @return array<int, array<string, mixed>>
     */
    private function newsItems(): array
    {
        return [
            [
                'slug' => 'skyitup-ouvre-un-bureau-a-goma',
                'featured_image' => 'assets/img/slider-4.png',
                'title' => [
                    'fr' => 'SkyITup ouvre un nouveau bureau à Goma',
                    'en' => 'SkyITup opens a new office in Goma',
                ],
                'excerpt' => [
                    'fr' => "Pour rapprocher ses services des entreprises de l'Est de la RDC, SkyITup inaugure une antenne à Goma dédiée à l'accompagnement digital.",
                    'en' => 'To bring its services closer to businesses in eastern DRC, SkyITup opens a Goma branch dedicated to digital support.',
                ],
                'content' => [
                    'fr' => '<p>SkyITup poursuit son expansion nationale avec l\'ouverture d\'un nouveau bureau à Goma. Cette antenne renforce notre présence dans l\'Est de la République Démocratique du Congo, aux côtés de Kinshasa, Lubumbashi et Bukavu.</p><p>Les équipes locales proposeront l\'ensemble de nos services : développement logiciel, ERP (Odoo), audit informatique, formation et support de proximité.</p>',
                    'en' => '<p>SkyITup continues its national expansion with the opening of a new office in Goma. This branch strengthens our presence in eastern DRC, alongside Kinshasa, Lubumbashi and Bukavu.</p><p>Local teams will offer our full range of services: software development, ERP (Odoo), IT audit, training and on-site support.</p>',
                ],
            ],
            [
                'slug' => 'partenariat-odoo-transformation-digitale',
                'featured_image' => 'assets/img/services/service-2.jpg',
                'title' => [
                    'fr' => 'Nouveau partenariat pour accélérer la transformation digitale',
                    'en' => 'New partnership to accelerate digital transformation',
                ],
                'excerpt' => [
                    'fr' => 'SkyITup consolide son expertise ERP afin d\'offrir des déploiements Odoo plus rapides et mieux adaptés aux PME congolaises.',
                    'en' => 'SkyITup strengthens its ERP expertise to deliver faster Odoo deployments tailored to Congolese SMEs.',
                ],
                'content' => [
                    'fr' => '<p>Dans le cadre de sa stratégie de digitalisation, SkyITup renforce son pôle ERP autour d\'Odoo. Objectif : réduire les délais de mise en œuvre et proposer des modules métiers prêts à l\'emploi (comptabilité OHADA, achats, ventes, stock, RH).</p><p>Nos consultants accompagnent chaque client de l\'audit initial jusqu\'à la formation des utilisateurs.</p>',
                    'en' => '<p>As part of its digitalization strategy, SkyITup is reinforcing its ERP practice around Odoo. The goal: shorten implementation times and offer ready-to-use business modules (OHADA accounting, purchasing, sales, inventory, HR).</p><p>Our consultants support each client from the initial audit to end-user training.</p>',
                ],
            ],
            [
                'slug' => 'cybersecurite-sensibilisation-entreprises',
                'featured_image' => 'assets/img/services/service-3.jpg',
                'title' => [
                    'fr' => 'Cybersécurité : SkyITup lance des sessions de sensibilisation',
                    'en' => 'Cybersecurity: SkyITup launches awareness sessions',
                ],
                'excerpt' => [
                    'fr' => 'Face à la hausse des menaces, SkyITup propose des ateliers pratiques pour protéger les données et les systèmes des organisations.',
                    'en' => 'Facing rising threats, SkyITup offers hands-on workshops to protect organizations\' data and systems.',
                ],
                'content' => [
                    'fr' => '<p>La sécurité informatique est devenue un enjeu majeur pour toutes les organisations. SkyITup lance un programme de sensibilisation à destination des équipes : bonnes pratiques, gestion des mots de passe, prévention du phishing et sauvegarde des données.</p><p>Ces sessions s\'inscrivent dans notre offre de formation à la transformation digitale.</p>',
                    'en' => '<p>Information security has become a major concern for every organization. SkyITup is launching an awareness program for teams: best practices, password management, phishing prevention and data backup.</p><p>These sessions are part of our digital transformation training offering.</p>',
                ],
            ],
        ];
    }
}
