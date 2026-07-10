<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\StoreNewsletterSubscriptionRequest as WebStoreNewsletterSubscriptionRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Variante API de l'inscription newsletter : renvoie une réponse JSON 422
 * en cas d'échec au lieu d'une redirection.
 */
class StoreNewsletterSubscriptionRequest extends WebStoreNewsletterSubscriptionRequest
{
    /**
     * Lève une exception JSON standard (422) au lieu de rediriger.
     *
     * @param  Validator  $validator  Validateur en échec
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator);
    }
}
