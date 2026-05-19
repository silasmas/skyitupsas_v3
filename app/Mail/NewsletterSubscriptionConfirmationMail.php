<?php

namespace App\Mail;

use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * E-mail de confirmation d’inscription à la newsletter.
 */
class NewsletterSubscriptionConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  NewsletterSubscriber  $subscriber  Abonné enregistré
     */
    public function __construct(
        public NewsletterSubscriber $subscriber,
    ) {}

    /**
     * Enveloppe du message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('site.newsletter_mail_subject'),
        );
    }

    /**
     * Contenu HTML du message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter-subscription-confirmation',
        );
    }
}
