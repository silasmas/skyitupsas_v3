<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * E-mail de confirmation envoyé à l’expéditeur d’un message de contact.
 */
class ContactMessageConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  ContactMessage  $contactMessage  Message enregistré
     */
    public function __construct(
        public ContactMessage $contactMessage,
    ) {}

    /**
     * Enveloppe du message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('site.contact_mail_subject'),
        );
    }

    /**
     * Contenu HTML du message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message-confirmation',
        );
    }
}
