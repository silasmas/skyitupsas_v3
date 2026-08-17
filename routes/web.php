<?php

use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Wizard d'installation (accessible uniquement si non installé)
|--------------------------------------------------------------------------
*/
Route::prefix('install')
    ->middleware('install.not_installed')
    ->group(function () {
        Route::get('/{step?}', [InstallController::class, 'index'])
            ->where('step', 'requirements|environment|database|finalize|complete')
            ->name('install.index');
        Route::post('/environment', [InstallController::class, 'saveEnvironment'])
            ->name('install.environment');
        Route::post('/database', [InstallController::class, 'runDatabase'])
            ->name('install.database');
        Route::post('/finish', [InstallController::class, 'finish'])
            ->name('install.finish');
        Route::post('/lock', [InstallController::class, 'lock'])
            ->name('install.lock');
    });

Route::get('/', function () {
    if (app()->environment('production')) {
        return redirect('/admin');
    }

    return redirect('/'.config('app.locale', 'fr'));
});

Route::prefix('{locale}')
    ->where(['locale' => 'fr|en'])
    ->middleware(['locale', 'redirect.public.to.frontend'])
    ->group(function () {
        Route::get('/', [SiteController::class, 'home'])->name('home');
        Route::get('/a-propos', [SiteController::class, 'about'])->name('about');
        Route::get('/notre-equipe', [SiteController::class, 'team'])->name('team');
        Route::get('/services', [SiteController::class, 'services'])->name('services');
        Route::get('/realisations', [SiteController::class, 'realisations'])->name('realisations');
        Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
        Route::post('/contact', [ContactMessageController::class, 'store'])
            ->middleware('throttle:10,1')
            ->name('contact.store');
        Route::post('/newsletter', [NewsletterController::class, 'subscribe'])
            ->middleware('throttle:15,1')
            ->name('newsletter.subscribe');
        Route::get('/recherche', [SearchController::class, 'index'])
            ->middleware('throttle:60,1')
            ->name('search');

        Route::get('/recrutement', [CareerController::class, 'index'])->name('careers');
        Route::get('/recrutement/{jobOffer}', [CareerController::class, 'show'])->name('careers.show');
        Route::get('/recrutement/{jobOffer}/candidature', [CareerController::class, 'applyRedirect'])
            ->name('careers.apply.redirect');
        Route::post('/recrutement/{jobOffer}/candidature', [CareerController::class, 'apply'])
            ->middleware('throttle:8,1')
            ->name('careers.apply');
    });

// Sitemap SEO : générer avec "php artisan sitemap:generate"
// Le fichier public/sitemap.xml sera servi à /sitemap.xml
