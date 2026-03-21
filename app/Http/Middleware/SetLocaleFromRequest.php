<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromRequest
{
    protected array $supportedLocales = ['fr', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->query('locale')
            ?? $request->header('X-Locale')
            ?? $request->cookie('locale');

        if ($locale && in_array($locale, $this->supportedLocales, true)) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
