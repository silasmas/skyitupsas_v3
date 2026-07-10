<?php

namespace App\Http\Resources\Concerns;

use Illuminate\Support\Facades\Storage;

/**
 * Résout des URLs d'images absolues, prêtes à être consommées par un
 * frontend headless (Next.js) hébergé sur une autre origine.
 */
trait ResolvesMediaUrls
{
    /**
     * Résout une URL d'image absolue depuis un chemin stocké.
     *
     * Gère les deux conventions du projet : les fichiers livrés dans
     * `public/assets/img` et les fichiers uploadés sur le disque `public`.
     *
     * @param  string|null  $path  Chemin ou nom de fichier stocké en base
     * @return string|null URL absolue de l'image, ou null si introuvable
     */
    protected function mediaUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (file_exists(public_path('assets/img/'.$path))) {
            return asset('assets/img/'.$path);
        }

        if (Storage::disk('public')->exists($path)) {
            return url(Storage::disk('public')->url($path));
        }

        return null;
    }
}
