<?php

namespace App\Http\Middleware;

use App\Services\InstallService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Empêche l'accès au wizard `/install` une fois l'application installée.
 */
class EnsureApplicationIsNotInstalled
{
    /**
     * @param  Request  $request  Requête entrante
     * @param  Closure  $next  Suite du pipeline
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app(InstallService::class)->isInstalled()) {
            return redirect('/');
        }

        return $next($request);
    }
}
