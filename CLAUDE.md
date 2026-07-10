# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Laravel 12 rebuild of the skyitupsas.com corporate site ("v3") with a full Filament admin panel, multi-language content, media management, and SEO tooling. Separate codebase from `skyitup` (v1), `skyitup_v2`, and the React-based `skyitup-refont`/`skyitup_template` — do not mix context between them.

Stack (from `SETUP.md`): Laravel 12, Filament v3.3 (admin panel), `filament-shield` (roles/permissions), Spatie Laravel Translatable (multi-lang JSON columns), Spatie Media Library (file/image management), Spatie Laravel Sitemap, Artesaos SEOTools (meta tags/Open Graph).

## Commands

- Full setup (composer script): `composer run setup` — installs PHP deps, copies `.env`, generates key, runs migrations, installs/builds npm assets.
- Install PHP deps only: `composer install`
- Install JS deps: `npm install`
- Dev (all-in-one, via `composer run dev`): runs `php artisan serve` + `php artisan queue:listen` + `php artisan pail` (logs) + `npm run dev` concurrently.
- Build assets: `npm run build`
- Create a Filament admin user: `php artisan make:filament-user`
- Generate sitemap: `php artisan sitemap:generate` (writes `public/sitemap.xml`; scheduled daily per `SETUP.md`)
- Run tests: `composer test` (clears config cache, then `php artisan test`) or `vendor/bin/phpunit`
- Run a single test: `php artisan test --filter=TestName`
- Code style: `vendor/bin/pint`

Admin panel: `/admin` (Filament). Public site: locale-prefixed, e.g. `/fr`, `/en`.

## Architecture

- **Routing** (`routes/web.php`): all public routes are under `Route::prefix('{locale}')->where(['locale' => 'fr|en'])->middleware(['locale'])`, root `/` redirects to `/{app.locale}`. Locale is resolved by `app/Http/Middleware/SetLocaleFromRequest.php`. Pages: home, `/a-propos`, `/notre-equipe`, `/services`, `/realisations`, `/contact` (GET+POST), `/recherche` (site search), `/recrutement` + `/recrutement/{jobOffer}` + apply flow — all French URL slugs. Contact, newsletter, and job-application POSTs are rate-limited via `throttle` middleware.
- **Controllers** (`app/Http/Controllers/`): thin — `SiteController` serves the static-ish pages (home/about/team/services/realisations/contact), `CareerController` handles job offers + applications, `ContactMessageController` and `NewsletterController` handle form submissions, `SearchController` delegates to `app/Services/SiteSearchService.php` (the one non-trivial service class — site-wide search logic lives here, not in the controller).
- **Domain models** (`app/Models/`): `About`, `Blog`, `Contact`, `ContactMessage`, `JobApplication`, `JobOffer`, `NewsletterSubscriber`, `Partner`, `Realisation`, `Service`, `TeamMember`, `User`. Content models use Spatie Translatable (JSON columns per locale) and likely Media Library (`HasMedia`/`InteractsWithMedia`) for images — check a model before assuming plain Eloquent.
- **Admin panel** (`app/Filament/`): one Filament Resource per content model under `app/Filament/Resources/*Resource/` (About, Blog, Contact, ContactMessage, JobApplication, JobOffer, NewsletterSubscriber, Partner, Realisation, Service, TeamMember, User) — this is where content editors manage site content, not migrations/seeders. `JobOfferResource` has a `RelationManagers/` subfolder (likely manages related `JobApplication`s inline). `app/Filament/Pages/Auth/` customizes the admin login. `app/Filament/Widgets/` holds dashboard widgets.
- **Authorization**: `app/Policies/` has one policy per Filament resource model (`AboutPolicy`, `BlogPolicy`, etc.) plus `RolePolicy`/`UserPolicy` for `filament-shield`-managed roles/permissions — check the relevant policy before adding new admin capabilities.
- **Mail** (`app/Mail/`): transactional confirmations — `ContactMessageConfirmationMail`, `JobApplicationConfirmationMail`, `NewsletterSubscriptionConfirmationMail` — rendered from `resources/views/emails/`.
- **Views**: `resources/views/pages/` (public site pages), `resources/views/partials/`, `resources/views/layouts/`, plus `resources/views/filament/` (custom Filament resource/widget view overrides) and `resources/views/vendor/filament-panels/` (published Filament panel view overrides).
- **Frontend build**: Tailwind CSS v4 via `@tailwindcss/vite`, Vite + `laravel-vite-plugin`, `shepherd.js` (guided tour/onboarding library) as the one runtime JS dependency — otherwise plain `resources/js/app.js`.
- **SEO**: Artesaos SEOTools facades (`SEOMeta`, `OpenGraph`) set per-page meta tags/Open Graph in controllers/views; sitemap generated via `spatie/laravel-sitemap`.
