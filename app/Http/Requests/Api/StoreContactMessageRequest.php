<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\StoreContactMessageRequest as WebStoreContactMessageRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Variante API du formulaire de contact : mêmes règles que la version web,
 * mais renvoie une réponse JSON 422 en cas d'échec au lieu d'une redirection.
 */
class StoreContactMessageRequest extends WebStoreContactMessageRequest
{
    /**
     * Règles de validation (source rendue optionnelle pour le front headless).
     *
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'source' => ['nullable', 'string', 'max:50'],
        ]);
    }

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
