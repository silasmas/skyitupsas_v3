<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreContactMessageRequest extends FormRequest
{
    /**
     * Autorise l’envoi public du formulaire contact.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation du message de contact.
     *
     * @return array<string, array<int, ValidationRule|string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:40'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'source' => ['required', 'string', Rule::in(['home_section', 'home_modal', 'contact_page'])],
            'consent_privacy' => ['accepted'],
        ];
    }

    /**
     * Messages d’erreur localisés.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        if (app()->getLocale() === 'en') {
            return [
                'name.required' => 'Please enter your name.',
                'email.required' => 'Please enter your email address.',
                'email.email' => 'The email address is not valid.',
                'message.required' => 'Please enter your message.',
                'message.min' => 'Your message must be at least 10 characters.',
                'consent_privacy.accepted' => 'You must accept the privacy policy.',
            ];
        }

        return [
            'name.required' => 'Veuillez saisir votre nom.',
            'email.required' => 'Veuillez saisir votre adresse e-mail.',
            'email.email' => 'L’adresse e-mail n’est pas valide.',
            'message.required' => 'Veuillez saisir votre message.',
            'message.min' => 'Votre message doit contenir au moins 10 caractères.',
            'consent_privacy.accepted' => 'Vous devez accepter la politique de confidentialité.',
        ];
    }

    /**
     * Redirige vers la page d’origine avec les erreurs.
     *
     * @param  Validator  $validator  Validateur en échec
     */
    protected function failedValidation(Validator $validator): void
    {
        $locale = (string) ($this->route('locale') ?? app()->getLocale());
        $redirectUrl = url()->previous() ?: route('contact', ['locale' => $locale]);

        throw new ValidationException($validator, redirect()->to($redirectUrl)
            ->withErrors($validator)
            ->withInput()
            ->with('contact_form_error', true));
    }
}
