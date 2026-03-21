<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Sitemap SEO : générer avec "php artisan sitemap:generate"
// Le fichier public/sitemap.xml sera servi à /sitemap.xml
