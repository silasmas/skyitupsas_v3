<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use App\Models\JobOffer;
use App\Models\Partner;
use App\Models\Realisation;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $partners = Partner::query()->active()->ordered()->get();
        $services = Service::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();
        $teamMembers = TeamMember::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();
        $jobOffers = JobOffer::query()->publishedForPublic()->ordered()->limit(6)->get();
        $homeRealisations = Realisation::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->take(3)->get();

        return view('pages.home', [
            'pageTitle' => null,
            'pageSubtitle' => 'Solutions et accompagnement sur mesure pour votre activité.',
            'bannerCompact' => false,
            'partners' => $partners,
            'homeServices' => $services->take(4),
            'teamMembers' => $teamMembers,
            'homeJobOffers' => $jobOffers->take(3),
            'homeRealisations' => $homeRealisations,
        ]);
    }

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

    public function services(): View
    {
        $services = Service::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();

        return view('pages.services', [
            'pageTitle' => __('site.page_services_title'),
            'pageSubtitle' => __('site.services_page_titlebar_lead'),
            'bannerCompact' => true,
            'services' => $services,
        ]);
    }

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
