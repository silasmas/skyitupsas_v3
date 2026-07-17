<?php

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
            'locale' => \App\Http\Middleware\SetLocaleFromRequest::class,
            'install.installed' => \App\Http\Middleware\EnsureApplicationIsInstalled::class,
            'install.not_installed' => \App\Http\Middleware\EnsureApplicationIsNotInstalled::class,
        ]);

        // Tant que l'app n'est pas installée, toute requête web (hors /install et /up)
        // est redirigée vers le wizard.
        $middleware->web(append: [
            \App\Http\Middleware\EnsureApplicationIsInstalled::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
