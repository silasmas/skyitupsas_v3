<?php

namespace App\Mail;

use App\Models\JobApplication;
use App\Models\JobOffer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * E-mail de confirmation envoyé au candidat après enregistrement.
 */
class JobApplicationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

  /**
   * @param  JobApplication  $application  Candidature enregistrée
   * @param  JobOffer  $offer  Offre concernée
   */
    public function __construct(
        public JobApplication $application,
        public JobOffer $offer,
    ) {}

    /**
     * Enveloppe du message (objet, destinataire).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('site.career_mail_subject', [
                'title' => $this->offer->getTranslation('title', $this->application->locale ?? app()->getLocale()),
            ]),
        );
    }

    /**
     * Contenu HTML du message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.career-application-confirmation',
        );
    }
}
