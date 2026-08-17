<?php

namespace App\Http\Middleware;

use App\Services\InstallService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Redirige vers le wizard d'installation tant que l'application n'est pas installée.
 *
 * Les routes `/install/*` et `/up` restent accessibles.
 */
class EnsureApplicationIsInstalled
{
    /**
     * @param  Request  $request  Requête entrante
     * @param  Closure  $next  Suite du pipeline
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $installer = app(InstallService::class);

        if ($installer->isInstalled()) {
            return $next($request);
        }

        if ($request->is('install') || $request->is('install/*') || $request->is('up')) {
            return $next($request);
        }

        return redirect()->route('install.index');
    }
}
