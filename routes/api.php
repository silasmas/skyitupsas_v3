<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\JobApplicationController;
use App\Http\Controllers\Api\JobOfferController;
use App\Http\Controllers\Api\NewsletterController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\RealisationController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ServiceModuleController;
use App\Http\Controllers\Api\ServicePillarController;
use App\Http\Controllers\Api\TeamMemberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API v1 (headless)
|--------------------------------------------------------------------------
|
| Endpoints consommés par le frontend Next.js. La locale est résolue par le
| middleware `locale` via `?locale=fr|en` ou l'en-tête `X-Locale`.
|
*/

Route::prefix('v1')->name('api.v1.')->middleware('locale')->group(function () {
    // Contenu en lecture seule
    Route::get('/abouts', [AboutController::class, 'index'])->name('abouts.index');
    Route::get('/abouts/{slug}', [AboutController::class, 'show'])->name('abouts.show');

    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

    Route::get('/service-pillars', [ServicePillarController::class, 'index'])->name('service-pillars.index');
    Route::get('/service-pillars/{slug}', [ServicePillarController::class, 'show'])->name('service-pillars.show');
    Route::get('/service-modules/{slug}', [ServiceModuleController::class, 'show'])->name('service-modules.show');

    Route::get('/realisations', [RealisationController::class, 'index'])->name('realisations.index');
    Route::get('/realisations/{slug}', [RealisationController::class, 'show'])->name('realisations.show');

    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{slug}', [ContactController::class, 'show'])->name('contacts.show');

    Route::get('/team-members', [TeamMemberController::class, 'index'])->name('team-members.index');
    Route::get('/team-members/{slug}', [TeamMemberController::class, 'show'])->name('team-members.show');

    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::get('/partners/{slug}', [PartnerController::class, 'show'])->name('partners.show');

    Route::get('/job-offers', [JobOfferController::class, 'index'])->name('job-offers.index');
    Route::get('/job-offers/{slug}', [JobOfferController::class, 'show'])->name('job-offers.show');

    // Recherche instantanée
    Route::get('/search', [SearchController::class, 'index'])
        ->middleware('throttle:60,1')
        ->name('search');

    // Formulaires publics (écriture)
    Route::post('/contact', [ContactMessageController::class, 'store'])
        ->middleware('throttle:10,1')
        ->name('contact.store');

    Route::post('/newsletter', [NewsletterController::class, 'subscribe'])
        ->middleware('throttle:15,1')
        ->name('newsletter.subscribe');

    Route::post('/job-offers/{slug}/applications', [JobApplicationController::class, 'store'])
        ->middleware('throttle:8,1')
        ->name('job-offers.applications.store');
});
