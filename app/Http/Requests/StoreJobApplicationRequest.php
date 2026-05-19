<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreJobApplicationRequest extends FormRequest
{
    /**
     * Autorise toute candidature publique.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation de la candidature.
     *
     * @return array<string, array<int, ValidationRule|string>>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:40'],
            'cover_letter' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'cv' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'linkedin_url' => ['nullable', 'url', 'max:500'],
            'consent_privacy' => ['accepted'],
        ];
    }

    /**
     * Messages d'erreur personnalisés par champ.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $locale = app()->getLocale();

        if ($locale === 'en') {
            return [
                'first_name.required' => 'Please enter your first name.',
                'last_name.required' => 'Please enter your last name.',
                'email.required' => 'Please enter your email address.',
                'email.email' => 'The email address is not valid.',
                'cover_letter.required' => 'Please attach your cover letter (PDF).',
                'cover_letter.mimes' => 'The cover letter must be a PDF file.',
                'cover_letter.max' => 'The cover letter must not exceed 5 MB.',
                'cv.required' => 'Please attach your CV (PDF).',
                'cv.mimes' => 'The CV must be a PDF file.',
                'cv.max' => 'The CV must not exceed 5 MB.',
                'consent_privacy.accepted' => 'You must accept the privacy policy.',
                'linkedin_url.url' => 'The LinkedIn URL is not valid.',
            ];
        }

        return [
            'first_name.required' => 'Veuillez saisir votre prénom.',
            'last_name.required' => 'Veuillez saisir votre nom.',
            'email.required' => 'Veuillez saisir votre adresse e-mail.',
            'email.email' => 'L’adresse e-mail n’est pas valide.',
            'cover_letter.required' => 'Veuillez joindre votre lettre de motivation (PDF).',
            'cover_letter.mimes' => 'La lettre de motivation doit être un fichier PDF.',
            'cover_letter.max' => 'La lettre de motivation ne doit pas dépasser 5 Mo.',
            'cv.required' => 'Veuillez joindre votre CV (PDF).',
            'cv.mimes' => 'Le CV doit être un fichier PDF.',
            'cv.max' => 'Le CV ne doit pas dépasser 5 Mo.',
            'consent_privacy.accepted' => 'Vous devez accepter la politique de confidentialité.',
            'linkedin_url.url' => 'L’URL LinkedIn n’est pas valide.',
        ];
    }

    /**
     * Redirige vers la page recrutement avec la modale candidature ouverte.
     *
     * @param  Validator  $validator  Validateur en échec
     */
    protected function failedValidation(Validator $validator): void
    {
        $slug = (string) $this->route('jobOffer');
        $locale = (string) ($this->route('locale') ?? app()->getLocale());

        throw new ValidationException($validator, redirect()
            ->route('careers', ['locale' => $locale, 'apply' => $slug])
            ->withErrors($validator)
            ->withInput());
    }
}
