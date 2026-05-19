<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreNewsletterSubscriptionRequest extends FormRequest
{
    /**
     * Autorise l’inscription newsletter publique.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation de l’inscription newsletter.
     *
     * @return array<string, array<int, ValidationRule|string>>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
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
                'email.required' => 'Please enter your email address.',
                'email.email' => 'The email address is not valid.',
            ];
        }

        return [
            'email.required' => 'Veuillez saisir votre adresse e-mail.',
            'email.email' => 'L’adresse e-mail n’est pas valide.',
        ];
    }

    /**
     * Redirige vers la page précédente avec les erreurs.
     *
     * @param  Validator  $validator  Validateur en échec
     */
    protected function failedValidation(Validator $validator): void
    {
        $locale = (string) ($this->route('locale') ?? app()->getLocale());
        $redirectUrl = url()->previous() ?: route('home', ['locale' => $locale]);

        throw new ValidationException($validator, redirect()->to($redirectUrl)
            ->withErrors($validator)
            ->withInput()
            ->with('newsletter_error', true));
    }
}
