<?php

use App\Http\Resources\AboutResource;
use App\Http\Resources\BlogResource;
use App\Http\Resources\ContactResource;
use App\Http\Resources\RealisationResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\TeamMemberResource;
use App\Models\About;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Realisation;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Route;

Route::middleware('locale')->group(function () {
    Route::get('/team-members', fn () => TeamMemberResource::collection(TeamMember::where('is_active', true)->orderBy('sort_order')->get()));
    Route::get('/team-members/{slug}', fn (string $slug) => new TeamMemberResource(TeamMember::where('slug', $slug)->where('is_active', true)->firstOrFail()));
    Route::delete('/team-members/{slug}', fn (string $slug) => TeamMember::where('slug', $slug)->firstOrFail()->delete() ? response()->noContent() : abort(500))->name('api.team-members.destroy');

    Route::get('/abouts', fn () => AboutResource::collection(About::where('is_active', true)->orderBy('sort_order')->get()));
    Route::get('/abouts/{slug}', fn (string $slug) => new AboutResource(About::where('slug', $slug)->where('is_active', true)->firstOrFail()));
    Route::delete('/abouts/{slug}', fn (string $slug) => About::where('slug', $slug)->firstOrFail()->delete() ? response()->noContent() : abort(500))->name('api.abouts.destroy');

    Route::get('/services', fn () => ServiceResource::collection(Service::where('is_active', true)->orderBy('sort_order')->get()));
    Route::get('/services/{slug}', fn (string $slug) => new ServiceResource(Service::where('slug', $slug)->where('is_active', true)->firstOrFail()));
    Route::delete('/services/{slug}', fn (string $slug) => Service::where('slug', $slug)->firstOrFail()->delete() ? response()->noContent() : abort(500))->name('api.services.destroy');

    Route::get('/blogs', fn () => BlogResource::collection(Blog::where('is_active', true)->orderBy('sort_order')->get()));
    Route::get('/blogs/{slug}', fn (string $slug) => new BlogResource(Blog::where('slug', $slug)->where('is_active', true)->firstOrFail()));
    Route::delete('/blogs/{slug}', fn (string $slug) => Blog::where('slug', $slug)->firstOrFail()->delete() ? response()->noContent() : abort(500))->name('api.blogs.destroy');

    Route::get('/contacts', fn () => ContactResource::collection(Contact::where('is_active', true)->orderBy('sort_order')->get()));
    Route::get('/contacts/{slug}', fn (string $slug) => new ContactResource(Contact::where('slug', $slug)->where('is_active', true)->firstOrFail()));
    Route::delete('/contacts/{slug}', fn (string $slug) => Contact::where('slug', $slug)->firstOrFail()->delete() ? response()->noContent() : abort(500))->name('api.contacts.destroy');

    Route::get('/realisations', fn () => RealisationResource::collection(Realisation::where('is_active', true)->orderBy('sort_order')->get()));
    Route::get('/realisations/{slug}', fn (string $slug) => new RealisationResource(Realisation::where('slug', $slug)->where('is_active', true)->firstOrFail()));
    Route::delete('/realisations/{slug}', fn (string $slug) => Realisation::where('slug', $slug)->firstOrFail()->delete() ? response()->noContent() : abort(500))->name('api.realisations.destroy');
});
