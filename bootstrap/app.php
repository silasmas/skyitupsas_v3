<?php

use App\Http\Middleware\EnsureApplicationIsInstalled;
use App\Http\Middleware\EnsureApplicationIsNotInstalled;
use App\Http\Middleware\RedirectPublicSiteToFrontend;
use App\Http\Middleware\SetLocaleFromRequest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'locale' => SetLocaleFromRequest::class,
            'install.installed' => EnsureApplicationIsInstalled::class,
            'install.not_installed' => EnsureApplicationIsNotInstalled::class,
            'redirect.public.to.frontend' => RedirectPublicSiteToFrontend::class,
        ]);

        // Tant que l'app n'est pas installée, toute requête web (hors /install et /up)
        // est redirigée vers le wizard.
        $middleware->web(append: [
            EnsureApplicationIsInstalled::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
