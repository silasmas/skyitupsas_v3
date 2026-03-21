<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Génère le sitemap XML pour le SEO';

    public function handle(): int
    {
        $this->info('Génération du sitemap...');

        SitemapGenerator::create(config('app.url'))
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap généré avec succès dans public/sitemap.xml');

        return self::SUCCESS;
    }
}
