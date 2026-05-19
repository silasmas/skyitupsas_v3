<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Mail\JobApplicationConfirmationMail;
use App\Models\JobApplication;
use App\Models\JobOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CareerController extends Controller
{
    /**
     * Liste des offres publiées.
     */
    public function index(): View
    {
        $offers = JobOffer::query()
            ->publishedForPublic()
            ->ordered()
            ->get();

        return view('pages.careers', [
            'offers' => $offers,
            'pageTitle' => __('site.page_careers_title'),
            'pageSubtitle' => __('site.page_careers_subtitle'),
        ]);
    }

    /**
     * Redirige vers la liste recrutement et ouvre la modale détail (?offer=slug).
     *
     * @param  string  $locale  Code langue (fr|en)
     * @param  string  $jobOffer  Slug de l'offre dans l'URL
     */
    public function show(string $locale, string $jobOffer): RedirectResponse
    {
        JobOffer::query()
            ->where('slug', $jobOffer)
            ->publishedForPublic()
            ->firstOrFail();

        return redirect()->route('careers', ['locale' => $locale, 'offer' => $jobOffer]);
    }

    /**
     * Redirige une requête GET sur /candidature vers la modale sur la liste.
     *
     * @param  string  $locale  Code langue
     * @param  string  $jobOffer  Slug de l'offre
     */
    public function applyRedirect(string $locale, string $jobOffer): RedirectResponse
    {
        return redirect()->route('careers', ['locale' => $locale, 'apply' => $jobOffer]);
    }

    /**
     * Enregistre une candidature pour l'offre identifiée par son slug.
     *
     * @param  string  $locale  Code langue
     * @param  string  $jobOffer  Slug de l'offre dans l'URL
     */
    public function apply(StoreJobApplicationRequest $request, string $locale, string $jobOffer): RedirectResponse
    {
        $offer = JobOffer::query()
            ->where('slug', $jobOffer)
            ->publishedForPublic()
            ->firstOrFail();

        if (! $offer->isOpenForApplications()) {
            abort(403);
        }

        $cvPath = $request->file('cv')->store('job-applications/'.$offer->id, 'public');
        $coverPath = $request->file('cover_letter')->store('job-applications/'.$offer->id, 'public');

        $application = JobApplication::query()->create([
            'job_offer_id' => $offer->id,
            'locale' => $locale,
            'first_name' => $request->validated('first_name'),
            'last_name' => $request->validated('last_name'),
            'email' => $request->validated('email'),
            'phone' => $request->validated('phone'),
            'cover_letter' => null,
            'cover_letter_path' => $coverPath,
            'cv_path' => $cvPath,
            'linkedin_url' => $request->validated('linkedin_url'),
            'status' => JobApplication::STATUS_PENDING,
            'ip_address' => $request->ip(),
            'consent_privacy' => true,
        ]);

        try {
            app()->setLocale($locale);
            Mail::to($application->email)->send(
                new JobApplicationConfirmationMail($application, $offer)
            );
        } catch (\Throwable $exception) {
            Log::error('career.application.mail_failed', [
                'application_id' => $application->id,
                'message' => $exception->getMessage(),
            ]);
        }

        return redirect()
            ->route('careers', ['locale' => $locale, 'apply' => $offer->slug])
            ->with('career_success', true)
            ->with('career_applied_slug', $offer->slug)
            ->with('career_toast', true);
    }
}
