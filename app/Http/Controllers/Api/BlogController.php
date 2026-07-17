<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogController extends AbstractContentController
{
    protected string $model = Blog::class;

    protected string $resource = BlogResource::class;

    /**
     * Liste les articles publiés (actifs et à la date de publication passée).
     *
     * Filtre optionnellement par type via le paramètre de requête `type`
     * (valeurs acceptées : `blog` ou `news`). Toute autre valeur est ignorée.
     *
     * @return AnonymousResourceCollection Collection d'articles sérialisés
     */
    public function index(): AnonymousResourceCollection
    {
        $query = Blog::query()
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());

        $type = request()->query('type');
        if (is_string($type) && array_key_exists($type, Blog::TYPES)) {
            $query->ofType($type);
        }

        $items = $query->orderByDesc('published_at')->get();

        return BlogResource::collection($items);
    }

    /**
     * Retourne un article publié identifié par son slug.
     *
     * @param  string  $slug  Slug de l'article
     * @return JsonResource Article sérialisé
     */
    public function show(string $slug): JsonResource
    {
        $blog = Blog::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        return new BlogResource($blog);
    }
}
