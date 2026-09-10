<?php

namespace App\Http\Resources\Concerns;

use Illuminate\Http\Request;

trait HasTranslations
{
    protected bool $withAllTranslations = false;

    /**
     * Indique si la réponse doit inclure toutes les locales (objet value/translations).
     *
     * La présence de `locale` (query ou middleware) ne doit PAS activer ce mode :
     * elle sert uniquement à choisir la langue courante. Passer `?translations=1`
     * pour obtenir le format multilingue complet.
     *
     * @param  Request  $request  Requête HTTP
     */
    protected function withTranslations(Request $request): bool
    {
        return $this->withAllTranslations
            || $request->boolean('translations');
    }

    protected function translatable(string $attribute): array
    {
        $model = $this->resource;

        if (! method_exists($model, 'getTranslations')) {
            return ['value' => $model->{$attribute}];
        }

        $translations = $model->getTranslations($attribute);

        return [
            'value' => $model->{$attribute},
            'translations' => $translations,
        ];
    }

    protected function formatTranslatable(string $attribute, bool $withTranslations = false): mixed
    {
        if ($withTranslations) {
            return $this->translatable($attribute);
        }

        return $this->resource->{$attribute};
    }
}
