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
     * Réécrit aussi les anciennes URLs localhost (APP_URL mal configuré).
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
            return $this->rewriteLocalhostUrl($path);
        }

        if (file_exists(public_path('assets/img/'.$path))) {
            return asset('assets/img/'.$path);
        }

        if (Storage::disk('public')->exists($path)) {
            return url(Storage::disk('public')->url($path));
        }

        // Chemin relatif connu : publier l'URL attendue même si le symlink
        // storage est en cours de réparation.
        if (! str_contains($path, '..')) {
            return url('/storage/'.ltrim($path, '/'));
        }

        return null;
    }

    /**
     * Remplace une URL absolue pointant vers localhost par l'APP_URL de prod.
     *
     * @param  string  $url  URL absolue éventuelle
     * @return string URL corrigée
     */
    protected function rewriteLocalhostUrl(string $url): string
    {
        $appUrl = rtrim((string) config('app.url'), '/');

        if ($appUrl === '' || str_contains($appUrl, '127.0.0.1') || str_contains($appUrl, 'localhost')) {
            return $url;
        }

        $rewritten = preg_replace(
            '#^https?://(?:127\.0\.0\.1|localhost)(?::\d+)?#i',
            $appUrl,
            $url
        );

        return is_string($rewritten) ? $rewritten : $url;
    }
}
