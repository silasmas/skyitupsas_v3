<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\StoreJobApplicationRequest as WebStoreJobApplicationRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Variante API de la candidature : renvoie une réponse JSON 422 en cas
 * d'échec au lieu de rediriger vers la modale de recrutement.
 */
class StoreJobApplicationRequest extends WebStoreJobApplicationRequest
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
