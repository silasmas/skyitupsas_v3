<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreNewsletterSubscriptionRequest;
use App\Mail\NewsletterSubscriptionConfirmationMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * Inscrit un e-mail à la newsletter et envoie la confirmation.
     *
     * La locale est résolue par le middleware `locale` (query/header).
     *
     * @param  StoreNewsletterSubscriptionRequest  $request  Requête validée
     * @return JsonResponse Confirmation (201) au format JSON
     */
    public function subscribe(StoreNewsletterSubscriptionRequest $request): JsonResponse
    {
        $locale = app()->getLocale();
        $email = strtolower($request->validated('email'));

        $subscriber = NewsletterSubscriber::query()->firstOrNew(['email' => $email]);
        $subscriber->fill([
            'locale' => $locale,
            'ip_address' => $request->ip(),
            'is_active' => true,
            'subscribed_at' => now(),
            'unsubscribed_at' => null,
        ]);
        $subscriber->save();

        $this->sendConfirmation($subscriber, $locale);

        return response()->json([
            'message' => __('site.newsletter_toast_body'),
        ], 201);
    }

    /**
     * Envoie l'e-mail de confirmation en isolant les erreurs d'envoi.
     *
     * @param  NewsletterSubscriber  $subscriber  Abonné enregistré
     * @param  string  $locale  Code langue (fr|en)
     */
    private function sendConfirmation(NewsletterSubscriber $subscriber, string $locale): void
    {
        try {
            app()->setLocale($locale);
            Mail::to($subscriber->email)->send(new NewsletterSubscriptionConfirmationMail($subscriber));
        } catch (\Throwable $exception) {
            Log::error('api.newsletter.subscribe.mail_failed', [
                'subscriber_id' => $subscriber->id,
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
