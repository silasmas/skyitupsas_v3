<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * En production, redirige les anciennes pages publiques Blade vers le frontend Next.js.
 *
 * Le backend admin/API ne doit pas servir le site vitrine : seul skyitupsas.org
 * héberge le frontend headless.
 */
class RedirectPublicSiteToFrontend
{
    /**
     * Redirige vers la première origine définie dans FRONTEND_URLS si l'app est en production.
     *
     * @param  Request  $request  Requête HTTP entrante
     * @param  Closure(Request): Response  $next  Suite du pipeline
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! app()->environment('production')) {
            return $next($request);
        }

        $frontendOrigins = array_filter(array_map('trim', explode(',', (string) env('FRONTEND_URLS', ''))));
        $frontendBase = rtrim($frontendOrigins[0] ?? 'https://skyitupsas.org', '/');
        $target = $frontendBase.$request->getRequestUri();

        return redirect()->away($target);
    }
}
