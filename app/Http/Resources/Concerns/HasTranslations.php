<?php

namespace App\Http\Resources\Concerns;

use Illuminate\Http\Request;

trait HasTranslations
{
    protected bool $withAllTranslations = false;

    protected function withTranslations(Request $request): bool
    {
        return $this->withAllTranslations
            || $request->boolean('translations')
            || $request->has('locale');
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

