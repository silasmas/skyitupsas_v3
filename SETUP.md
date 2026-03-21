# Configuration du projet Skyitupsas v3

Projet Laravel 12 avec Filament, multi-langue, gestion de fichiers et SEO.

## Stack technique

- **Laravel** 12.55.0
- **Filament** v3.3 – Panel admin
- **Spatie Laravel Translatable** – Multi-langue
- **Spatie Laravel Media Library** – Gestion de fichiers
- **Spatie Laravel Sitemap** – Sitemap XML
- **Artesaos SEOTools** – Meta tags SEO (Open Graph, Twitter Cards)

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build
```

## Créer un utilisateur admin Filament

```bash
php artisan make:filament-user
```

Accès admin : **/admin**

## Multi-langue (Translatable)

1. Ajouter le trait sur vos modèles :

```php
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'content'];
}
```

2. Les colonnes doivent être de type `json` pour stocker les traductions.

3. Langues disponibles : `fr`, `en` (config `config/app.php` → `available_locales`)

## Gestion des fichiers (Media Library)

1. Ajouter sur vos modèles :

```php
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }
}
```

2. Utilisation :

```php
$post->addMedia($request->file('image'))->toMediaCollection('images');
$post->getFirstMediaUrl('images');
```

## SEO

### Meta tags (SEOTools)

Dans vos contrôleurs ou vues :

```php
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

SEOMeta::setTitle('Page Title');
SEOMeta::setDescription('Description');
OpenGraph::setTitle('Title');
```

### Sitemap

Générer le sitemap :

```bash
php artisan sitemap:generate
```

Le fichier est créé dans `public/sitemap.xml`. Planifier la génération dans `app/Console/Kernel.php` :

```php
$schedule->command('sitemap:generate')->daily();
```

## Lancement

```bash
php artisan serve
```

- Site : http://localhost:8000
- Admin : http://localhost:8000/admin
