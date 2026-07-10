<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreContactMessageRequest;
use App\Mail\ContactMessageConfirmationMail;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    /**
     * Enregistre un message de contact et envoie l'e-mail de confirmation.
     *
     * La locale est résolue par le middleware `locale` (query/header).
     *
     * @param  StoreContactMessageRequest  $request  Requête validée
     * @return JsonResponse Confirmation (201) au format JSON
     */
    public function store(StoreContactMessageRequest $request): JsonResponse
    {
        $locale = app()->getLocale();

        $message = ContactMessage::query()->create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'phone' => $request->validated('phone'),
            'message' => $request->validated('message'),
            'source' => $request->validated('source') ?? ContactMessage::SOURCE_CONTACT_PAGE,
            'locale' => $locale,
            'ip_address' => $request->ip(),
            'consent_privacy' => true,
            'status' => ContactMessage::STATUS_NEW,
        ]);

        $this->sendConfirmation($message, $locale);

        return response()->json([
            'message' => __('site.contact_toast_body'),
        ], 201);
    }

    /**
     * Envoie l'e-mail de confirmation en isolant les erreurs d'envoi.
     *
     * @param  ContactMessage  $message  Message enregistré
     * @param  string  $locale  Code langue (fr|en)
     */
    private function sendConfirmation(ContactMessage $message, string $locale): void
    {
        try {
            app()->setLocale($locale);
            Mail::to($message->email)->send(new ContactMessageConfirmationMail($message));
        } catch (\Throwable $exception) {
            Log::error('api.contact.message.mail_failed', [
                'message_id' => $message->id,
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
