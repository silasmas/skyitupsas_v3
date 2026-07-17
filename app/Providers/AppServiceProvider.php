<?php

namespace App\Providers;

use App\Services\InstallService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * Avant l'installation, force session/cache fichier pour que le wizard
     * fonctionne même si les tables BDD n'existent pas encore.
     */
    public function boot(): void
    {
        if (! app(InstallService::class)->isInstalled()) {
            config([
                'session.driver' => 'file',
                'cache.default' => 'file',
            ]);
        }
    }
}
