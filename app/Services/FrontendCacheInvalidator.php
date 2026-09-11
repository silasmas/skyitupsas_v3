<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Demande au frontend Next.js d'invalider son cache ISR après une édition CMS.
 */
class FrontendCacheInvalidator
{
    /**
     * Déclenche la revalidation (debounce 5 s pour éviter les rafales Filament).
     */
    public function invalidate(): void
    {
        $url = (string) config('services.frontend.revalidate_url', '');
        $secret = (string) config('services.frontend.revalidate_secret', '');

        if ($url === '' || $secret === '') {
            return;
        }

        if (! Cache::add('frontend-revalidate-debounce', true, 5)) {
            return;
        }

        dispatch(function () use ($url, $secret): void {
            try {
                $response = Http::timeout(8)
                    ->withToken($secret)
                    ->acceptJson()
                    ->post($url, [
                        'tags' => ['cms'],
                    ]);

                if (! $response->successful()) {
                    Log::warning('Revalidation frontend échouée', [
                        'status' => $response->status(),
                        'body' => $response->body(),
                    ]);
                }
            } catch (Throwable $exception) {
                Log::warning('Revalidation frontend impossible', [
                    'message' => $exception->getMessage(),
                ]);
            }
        })->afterResponse();
    }
}
