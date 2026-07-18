<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BlogSeeder extends Seeder
{
    /**
     * Insère des articles de blog de démonstration (type « blog »).
     *
     * Utilise updateOrCreate sur le slug pour rester idempotent : relancer
     * le seeder met à jour les enregistrements existants sans créer de doublon.
     */
    public function run(): void
    {
        foreach ($this->blogItems() as $index => $item) {
            Blog::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'type' => Blog::TYPE_BLOG,
                    'title' => $item['title'],
                    'excerpt' => $item['excerpt'],
                    'content' => $item['content'],
                    'meta_description' => $item['excerpt'],
                    'featured_image' => $item['featured_image'],
                    'published_at' => Carbon::now()->subDays($index * 10 + 3),
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }
    }

    /**
     * Données des articles de blog de démonstration (contenu bilingue fr/en).
     *
     * @return array<int, array<string, mixed>>
     */
    private function blogItems(): array
    {
        return [
            [
                'slug' => 'pourquoi-choisir-odoo-pour-votre-pme',
                'featured_image' => 'assets/img/services/service-1.jpg',
                'title' => [
                    'fr' => 'Pourquoi choisir Odoo pour votre PME ?',
                    'en' => 'Why choose Odoo for your SME?',
                ],
                'excerpt' => [
                    'fr' => 'Odoo centralise vos processus métiers — ventes, achats, comptabilité, RH — dans une plateforme modulaire adaptée aux PME africaines.',
                    'en' => 'Odoo centralizes your business processes — sales, purchasing, accounting, HR — in a modular platform tailored to African SMEs.',
                ],
                'content' => [
                    'fr' => '<p>De nombreuses PME congolaises jonglent encore entre des fichiers Excel, des outils disparates et des processus manuels. Odoo propose une alternative intégrée : un ERP open source modulaire que l\'on adapte à la taille et aux besoins de chaque organisation.</p><p>SkyITup accompagne ses clients de l\'audit initial à la formation des équipes, avec une expertise locale sur la comptabilité OHADA et les spécificités du marché congolais.</p>',
                    'en' => '<p>Many Congolese SMEs still juggle Excel files, disparate tools and manual processes. Odoo offers an integrated alternative: a modular open-source ERP tailored to each organization\'s size and needs.</p><p>SkyITup supports clients from the initial audit to team training, with local expertise in OHADA accounting and Congolese market specifics.</p>',
                ],
            ],
            [
                'slug' => 'developpement-sur-mesure-vs-solutions-packaged',
                'featured_image' => 'assets/img/services/service-2.jpg',
                'title' => [
                    'fr' => 'Développement sur mesure vs solutions packagées',
                    'en' => 'Custom development vs packaged solutions',
                ],
                'excerpt' => [
                    'fr' => 'Faut-il développer une application sur mesure ou opter pour une solution existante ? Les critères pour faire le bon choix.',
                    'en' => 'Should you build a custom application or choose an existing solution? Key criteria to make the right decision.',
                ],
                'content' => [
                    'fr' => '<p>Le choix entre développement sur mesure et solution packagée dépend de vos contraintes : budget, délais, processus métiers spécifiques et évolutivité. Une solution standard convient souvent pour démarrer rapidement ; le sur mesure devient pertinent lorsque vos workflows sont uniques.</p><p>Chez SkyITup, nous commençons par un audit pour identifier la voie la plus rentable — parfois un mix des deux approches.</p>',
                    'en' => '<p>The choice between custom development and a packaged solution depends on your constraints: budget, timeline, specific business processes and scalability. A standard solution often works to get started quickly; custom development becomes relevant when your workflows are unique.</p><p>At SkyITup, we start with an audit to identify the most cost-effective path — sometimes a mix of both approaches.</p>',
                ],
            ],
            [
                'slug' => '5-bonnes-pratiques-pour-reussir-votre-transformation-digitale',
                'featured_image' => 'assets/img/services/service-3.jpg',
                'title' => [
                    'fr' => '5 bonnes pratiques pour réussir votre transformation digitale',
                    'en' => '5 best practices for a successful digital transformation',
                ],
                'excerpt' => [
                    'fr' => 'Impliquer les équipes, prioriser les quick wins, sécuriser les données : nos conseils pour une digitalisation durable.',
                    'en' => 'Involve teams, prioritize quick wins, secure data: our tips for sustainable digitalization.',
                ],
                'content' => [
                    'fr' => '<p>La transformation digitale ne se limite pas à acheter un logiciel. Voici cinq principes que nous appliquons avec nos clients : impliquer les utilisateurs dès le départ, commencer par des gains rapides visibles, documenter les processus existants, former continuellement les équipes et ne jamais négliger la cybersécurité.</p><p>Ces fondations permettent d\'ancrer le changement dans la durée plutôt que de subir des échecs coûteux.</p>',
                    'en' => '<p>Digital transformation is not just about buying software. Here are five principles we apply with our clients: involve users from the start, begin with visible quick wins, document existing processes, train teams continuously and never neglect cybersecurity.</p><p>These foundations help embed change for the long term rather than facing costly failures.</p>',
                ],
            ],
            [
                'slug' => 'audit-informatique-quand-et-pourquoi',
                'featured_image' => 'assets/img/services/service-4.jpg',
                'title' => [
                    'fr' => 'Audit informatique : quand et pourquoi le réaliser ?',
                    'en' => 'IT audit: when and why should you do it?',
                ],
                'excerpt' => [
                    'fr' => 'Un audit IT permet d\'évaluer la maturité de votre système d\'information et d\'identifier les risques avant qu\'ils ne deviennent critiques.',
                    'en' => 'An IT audit assesses your information system maturity and identifies risks before they become critical.',
                ],
                'content' => [
                    'fr' => '<p>Un audit informatique est recommandé avant tout projet de migration, après une incident de sécurité, ou lors d\'une croissance rapide de l\'organisation. Il couvre l\'infrastructure, les applications, les sauvegardes, les accès et la conformité.</p><p>SkyITup propose des audits adaptés aux réalités des entreprises congolaises, avec des recommandations priorisées et un plan d\'action concret.</p>',
                    'en' => '<p>An IT audit is recommended before any migration project, after a security incident, or during rapid organizational growth. It covers infrastructure, applications, backups, access control and compliance.</p><p>SkyITup offers audits tailored to Congolese businesses, with prioritized recommendations and a concrete action plan.</p>',
                ],
            ],
            [
                'slug' => 'formation-digitale-investir-dans-vos-equipes',
                'featured_image' => 'assets/img/slider-3.png',
                'title' => [
                    'fr' => 'Formation digitale : investir dans vos équipes',
                    'en' => 'Digital training: invest in your teams',
                ],
                'excerpt' => [
                    'fr' => 'La technologie ne crée de la valeur que si les équipes savent l\'utiliser. Découvrez notre approche de formation pratique.',
                    'en' => 'Technology only creates value when teams know how to use it. Discover our hands-on training approach.',
                ],
                'content' => [
                    'fr' => '<p>Trop de projets digitaux échouent non pas à cause de la technologie, mais faute de compétences en interne. SkyITup propose des formations sur mesure : prise en main d\'Odoo, bureautique avancée, cybersécurité, gestion de projet agile.</p><p>Nos sessions sont concrètes, basées sur vos cas d\'usage réels, et disponibles en présentiel ou à distance.</p>',
                    'en' => '<p>Too many digital projects fail not because of technology, but due to lack of in-house skills. SkyITup offers tailored training: Odoo onboarding, advanced office tools, cybersecurity, agile project management.</p><p>Our sessions are practical, based on your real use cases, and available on-site or remotely.</p>',
                ],
            ],
        ];
    }
}
