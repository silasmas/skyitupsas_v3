<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsletterSubscriptionRequest;
use App\Mail\NewsletterSubscriptionConfirmationMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * Inscrit un e-mail à la newsletter et envoie la confirmation.
     *
     * @param  string  $locale  Code langue (fr|en)
     */
    public function subscribe(StoreNewsletterSubscriptionRequest $request, string $locale): RedirectResponse
    {
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

        try {
            app()->setLocale($locale);
            Mail::to($subscriber->email)->send(new NewsletterSubscriptionConfirmationMail($subscriber));
        } catch (\Throwable $exception) {
            Log::error('newsletter.subscribe.mail_failed', [
                'subscriber_id' => $subscriber->id,
                'error' => $exception->getMessage(),
            ]);
        }

        return redirect()->back()
            ->with('newsletter_success', true)
            ->with('site_toast', true)
            ->with('site_toast_type', 'newsletter');
    }
}
