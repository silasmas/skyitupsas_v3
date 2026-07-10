<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        $supported = config('app.available_locales', ['fr', 'en']);

        if ($request->route()?->hasParameter('locale')) {
            $locale = $request->route('locale');
            if (! in_array($locale, $supported, true)) {
                abort(404);
            }
            App::setLocale($locale);
            URL::defaults(['locale' => $locale]);
            if ($request->hasSession()) {
                $request->session()->put('locale', $locale);
            }

            return $next($request);
        }

        $sessionLocale = $request->hasSession() ? $request->session()->get('locale') : null;

        $locale = $request->query('locale')
            ?? $request->header('X-Locale')
            ?? $sessionLocale;

        if ($locale && in_array($locale, $supported, true)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
