<?php

namespace App\Services;

use App\Models\JobOffer;
use App\Models\Realisation;
use App\Models\Service;
use App\Models\ServiceModule;
use App\Models\ServicePillar;
use Illuminate\Support\Str;

/**
 * Recherche instantanée sur le contenu public du site.
 */
class SiteSearchService
{
    /**
     * Recherche dans les contenus actifs et retourne des résultats normalisés.
     *
     * @param  string  $query  Terme recherché
     * @param  string  $locale  Langue (fr|en)
     * @param  int  $limit  Nombre max de résultats
     * @return array<int, array<string, string>>
     */
    public function search(string $query, string $locale, int $limit = 10): array
    {
        $needle = mb_strtolower(trim($query));
        if (mb_strlen($needle) < 2) {
            return [];
        }

        $results = [];

        $this->collectServicePillars($needle, $locale, $results);
        $this->collectServiceModules($needle, $locale, $results);
        $this->collectServices($needle, $locale, $results);
        $this->collectRealisations($needle, $locale, $results);
        $this->collectJobOffers($needle, $locale, $results);
        $this->collectStaticPages($needle, $locale, $results);

        return array_slice($results, 0, $limit);
    }

    /**
     * Ajoute les piliers de services correspondants.
     *
     * @param  string  $needle  Terme en minuscules
     * @param  string  $locale  Langue
     * @param  array<int, array<string, string>>  $results  Résultats cumulés
     */
    private function collectServicePillars(string $needle, string $locale, array &$results): void
    {
        $items = ServicePillar::query()->where('is_active', true)->orderBy('sort_order')->get();

        foreach ($items as $pillar) {
            $title = (string) $pillar->getTranslation('title', $locale);
            $summary = strip_tags((string) $pillar->getTranslation('offer_summary', $locale, false));
            if (! $this->matches($needle, $title.' '.$summary)) {
                continue;
            }
            $results[] = [
                'type' => 'service_pillar',
                'title' => $title,
                'excerpt' => Str::limit($summary, 100),
                'url' => route('services', ['locale' => $locale]).'#'.$pillar->slug,
            ];
        }
    }

    /**
     * Ajoute les modules de services correspondants.
     *
     * @param  string  $needle  Terme en minuscules
     * @param  string  $locale  Langue
     * @param  array<int, array<string, string>>  $results  Résultats cumulés
     */
    private function collectServiceModules(string $needle, string $locale, array &$results): void
    {
        $items = ServiceModule::query()
            ->where('is_active', true)
            ->with('pillar')
            ->orderBy('sort_order')
            ->get();

        foreach ($items as $module) {
            $title = (string) $module->getTranslation('title', $locale);
            $summary = strip_tags((string) $module->getTranslation('summary_text', $locale, false));
            $benefit = strip_tags((string) $module->getTranslation('benefit_text', $locale, false));
            if (! $this->matches($needle, $title.' '.$summary.' '.$benefit)) {
                continue;
            }
            $pillarSlug = $module->pillar?->slug ?? 'services';
            $results[] = [
                'type' => 'service_module',
                'title' => $title,
                'excerpt' => Str::limit($summary ?: $benefit, 100),
                'url' => route('services', ['locale' => $locale]).'/'.$pillarSlug.'/'.$module->slug,
            ];
        }
    }

    /**
     * Ajoute les services correspondants.
     *
     * @param  string  $needle  Terme en minuscules
     * @param  string  $locale  Langue
     * @param  array<int, array<string, string>>  $results  Résultats cumulés
     */
    private function collectServices(string $needle, string $locale, array &$results): void
    {
        $items = Service::query()->where('is_active', true)->orderBy('sort_order')->get();

        foreach ($items as $service) {
            $title = (string) $service->getTranslation('title', $locale);
            $description = strip_tags((string) $service->getTranslation('description', $locale, false));
            if (! $this->matches($needle, $title.' '.$description)) {
                continue;
            }
            $results[] = [
                'type' => 'service',
                'title' => $title,
                'excerpt' => Str::limit($description, 100),
                'url' => route('services', ['locale' => $locale]).'?service='.$service->slug,
            ];
        }
    }

    /**
     * Ajoute les réalisations correspondantes.
     *
     * @param  string  $needle  Terme en minuscules
     * @param  string  $locale  Langue
     * @param  array<int, array<string, string>>  $results  Résultats cumulés
     */
    private function collectRealisations(string $needle, string $locale, array &$results): void
    {
        $items = Realisation::query()->where('is_active', true)->orderBy('sort_order')->get();

        foreach ($items as $realisation) {
            $title = (string) $realisation->getTranslation('title', $locale);
            $description = strip_tags((string) $realisation->getTranslation('description', $locale, false));
            if (! $this->matches($needle, $title.' '.$description)) {
                continue;
            }
            $results[] = [
                'type' => 'realisation',
                'title' => $title,
                'excerpt' => Str::limit($description, 100),
                'url' => route('realisations', ['locale' => $locale]),
            ];
        }
    }

    /**
     * Ajoute les offres d’emploi correspondantes.
     *
     * @param  string  $needle  Terme en minuscules
     * @param  string  $locale  Langue
     * @param  array<int, array<string, string>>  $results  Résultats cumulés
     */
    private function collectJobOffers(string $needle, string $locale, array &$results): void
    {
        $items = JobOffer::query()->publishedForPublic()->ordered()->get();

        foreach ($items as $offer) {
            $title = (string) $offer->getTranslation('title', $locale);
            $description = strip_tags((string) $offer->getTranslation('description', $locale, false));
            if (! $this->matches($needle, $title.' '.$description)) {
                continue;
            }
            $results[] = [
                'type' => 'job',
                'title' => $title,
                'excerpt' => Str::limit($description, 100),
                'url' => route('careers', ['locale' => $locale, 'offer' => $offer->slug]),
            ];
        }
    }

    /**
     * Ajoute les pages statiques correspondantes.
     *
     * @param  string  $needle  Terme en minuscules
     * @param  string  $locale  Langue
     * @param  array<int, array<string, string>>  $results  Résultats cumulés
     */
    private function collectStaticPages(string $needle, string $locale, array &$results): void
    {
        $pages = [
            ['title' => __('site.nav_home'), 'url' => route('home', ['locale' => $locale])],
            ['title' => __('site.nav_about'), 'url' => route('about', ['locale' => $locale])],
            ['title' => __('site.nav_services'), 'url' => route('services', ['locale' => $locale])],
            ['title' => __('site.nav_realisations'), 'url' => route('realisations', ['locale' => $locale])],
            ['title' => __('site.nav_careers'), 'url' => route('careers', ['locale' => $locale])],
            ['title' => __('site.nav_contact'), 'url' => route('contact', ['locale' => $locale])],
            ['title' => __('site.nav_team'), 'url' => route('team', ['locale' => $locale])],
        ];

        foreach ($pages as $page) {
            if ($this->matches($needle, $page['title'])) {
                $results[] = [
                    'type' => 'page',
                    'title' => $page['title'],
                    'excerpt' => '',
                    'url' => $page['url'],
                ];
            }
        }
    }

    /**
     * Vérifie si le texte contient le terme recherché.
     *
     * @param  string  $needle  Terme
     * @param  string  $haystack  Texte
     */
    private function matches(string $needle, string $haystack): bool
    {
        return str_contains(mb_strtolower($haystack), $needle);
    }
}
