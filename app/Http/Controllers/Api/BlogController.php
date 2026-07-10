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
     * @return AnonymousResourceCollection Collection d'articles sérialisés
     */
    public function index(): AnonymousResourceCollection
    {
        $items = Blog::query()
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->get();

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
