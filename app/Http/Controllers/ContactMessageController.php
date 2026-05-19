<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Mail\ContactMessageConfirmationMail;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    /**
     * Enregistre un message de contact et envoie l’e-mail de confirmation.
     *
     * @param  string  $locale  Code langue (fr|en)
     */
    public function store(StoreContactMessageRequest $request, string $locale): RedirectResponse
    {
        $message = ContactMessage::query()->create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'phone' => $request->validated('phone'),
            'message' => $request->validated('message'),
            'source' => $request->validated('source'),
            'locale' => $locale,
            'ip_address' => $request->ip(),
            'consent_privacy' => true,
            'status' => ContactMessage::STATUS_NEW,
        ]);

        try {
            app()->setLocale($locale);
            Mail::to($message->email)->send(new ContactMessageConfirmationMail($message));
        } catch (\Throwable $exception) {
            Log::error('contact.message.mail_failed', [
                'message_id' => $message->id,
                'error' => $exception->getMessage(),
            ]);
        }

        $redirect = $this->redirectAfterContact($request->validated('source'), $locale);

        return $redirect
            ->with('contact_success', true)
            ->with('site_toast', true)
            ->with('site_toast_type', 'contact');
    }

    /**
     * Détermine l’URL de redirection selon la source du formulaire.
     *
     * @param  string  $source  Source du formulaire
     * @param  string  $locale  Code langue
     */
    private function redirectAfterContact(string $source, string $locale): RedirectResponse
    {
        if ($source === ContactMessage::SOURCE_HOME_SECTION) {
            return redirect()->route('home', ['locale' => $locale])->withFragment('contact');
        }

        if ($source === ContactMessage::SOURCE_HOME_MODAL) {
            return redirect()->route('home', ['locale' => $locale])->withFragment('contact-modal');
        }

        return redirect()->route('contact', ['locale' => $locale]);
    }
}
