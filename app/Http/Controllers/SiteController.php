<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use App\Models\JobOffer;
use App\Models\Partner;
use App\Models\Realisation;
use App\Models\ServicePillar;
use App\Models\TeamMember;
use Illuminate\View\View;

/**
 * Pages publiques du site corporate (Blade).
 */
class SiteController extends Controller
{
    /**
     * Page d'accueil.
     *
     * @return View Vue home
     */
    public function home(): View
    {
        $partners = Partner::query()->active()->ordered()->get();
        $pillars = ServicePillar::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->with(['activeModules'])
            ->get();
        $teamMembers = TeamMember::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();
        $jobOffers = JobOffer::query()->publishedForPublic()->ordered()->limit(6)->get();
        $homeRealisations = Realisation::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->take(3)->get();

        return view('pages.home', [
            'pageTitle' => null,
            'pageSubtitle' => 'Solutions et accompagnement sur mesure pour votre activité.',
            'bannerCompact' => false,
            'partners' => $partners,
            'homeServices' => $pillars->take(5),
            'teamMembers' => $teamMembers,
            'homeJobOffers' => $jobOffers->take(3),
            'homeRealisations' => $homeRealisations,
        ]);
    }

    /**
     * Page À propos.
     *
     * @return View Vue about
     */
    public function about(): View
    {
        $about = About::query()->where('is_active', true)->orderBy('sort_order')->first();

        return view('pages.about', [
            'pageTitle' => __('site.page_about_title'),
            'pageSubtitle' => __('site.about_titlebar_lead'),
            'bannerCompact' => true,
            'about' => $about,
        ]);
    }

    /**
     * Page équipe.
     *
     * @return View Vue team
     */
    public function team(): View
    {
        $members = TeamMember::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();

        return view('pages.team', [
            'pageTitle' => __('site.page_team_title'),
            'pageSubtitle' => __('site.page_team_intro'),
            'bannerCompact' => true,
            'members' => $members,
        ]);
    }

    /**
     * Page services : 5 piliers stratégiques et leurs modules.
     *
     * @return View Vue services
     */
    public function services(): View
    {
        $pillars = ServicePillar::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->with(['activeModules'])
            ->get();

        return view('pages.services', [
            'pageTitle' => __('site.page_services_title'),
            'pageSubtitle' => __('site.services_page_titlebar_lead'),
            'bannerCompact' => true,
            'pillars' => $pillars,
        ]);
    }

    /**
     * Page réalisations.
     *
     * @return View Vue realisations
     */
    public function realisations(): View
    {
        $realisations = Realisation::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();

        return view('pages.realisations', [
            'pageTitle' => __('site.page_realisations_title'),
            'pageSubtitle' => __('site.page_realisations_intro'),
            'bannerCompact' => true,
            'realisations' => $realisations,
        ]);
    }

    /**
     * Page contact.
     *
     * @return View Vue contact
     */
    public function contact(): View
    {
        $contact = Contact::query()->where('is_active', true)->orderBy('sort_order')->first();

        return view('pages.contact', [
            'pageTitle' => __('site.page_contact_title'),
            'pageSubtitle' => __('site.contact_page_subtitle'),
            'bannerCompact' => true,
            'contact' => $contact,
        ]);
    }
}
