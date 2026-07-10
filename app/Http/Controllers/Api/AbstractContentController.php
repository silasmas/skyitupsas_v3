<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Contrôleur de base pour les ressources de contenu en lecture seule.
 *
 * Factorise le pattern commun « liste des éléments actifs triés » et
 * « détail par slug ». Les contrôleurs concrets déclarent uniquement le
 * modèle et la resource à utiliser.
 */
abstract class AbstractContentController extends Controller
{
    /**
     * Classe du modèle Eloquent exposé.
     *
     * @var class-string<Model>
     */
    protected string $model;

    /**
     * Classe de la resource API utilisée pour la sérialisation.
     *
     * @var class-string<JsonResource>
     */
    protected string $resource;

    /**
     * Liste les éléments actifs triés par ordre d'affichage.
     *
     * @return AnonymousResourceCollection Collection sérialisée
     */
    public function index(): AnonymousResourceCollection
    {
        $items = $this->model::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return $this->resource::collection($items);
    }

    /**
     * Retourne un élément actif identifié par son slug.
     *
     * @param  string  $slug  Slug de l'élément
     * @return JsonResource Élément sérialisé
     */
    public function show(string $slug): JsonResource
    {
        $item = $this->model::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return new $this->resource($item);
    }
}
