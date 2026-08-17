<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreJobApplicationRequest;
use App\Mail\JobApplicationConfirmationMail;
use App\Models\JobApplication;
use App\Models\JobOffer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class JobApplicationController extends Controller
{
    /**
     * Enregistre une candidature pour l'offre identifiée par son slug.
     *
     * La locale est résolue par le middleware `locale` (query/header).
     *
     * @param  StoreJobApplicationRequest  $request  Requête validée (CV + LM en PDF)
     * @param  string  $slug  Slug de l'offre d'emploi
     * @return JsonResponse Confirmation (201) au format JSON
     */
    public function store(StoreJobApplicationRequest $request, string $slug): JsonResponse
    {
        $locale = app()->getLocale();

        $offer = JobOffer::query()
            ->where('slug', $slug)
            ->publishedForPublic()
            ->firstOrFail();

        abort_unless($offer->isOpenForApplications(), 403);

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

        $this->sendConfirmation($application, $offer, $locale);

        return response()->json([
            'message' => __('site.career_form_success'),
        ], 201);
    }

    /**
     * Envoie l'e-mail de confirmation en isolant les erreurs d'envoi.
     *
     * @param  JobApplication  $application  Candidature enregistrée
     * @param  JobOffer  $offer  Offre concernée
     * @param  string  $locale  Code langue (fr|en)
     */
    private function sendConfirmation(JobApplication $application, JobOffer $offer, string $locale): void
    {
        try {
            app()->setLocale($locale);
            Mail::to($application->email)->send(new JobApplicationConfirmationMail($application, $offer));
        } catch (\Throwable $exception) {
            Log::error('api.career.application.mail_failed', [
                'application_id' => $application->id,
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
