<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerController extends Controller
{
    /**
     * Liste les partenaires actifs triés par ordre d'affichage.
     *
     * @return AnonymousResourceCollection Collection de partenaires sérialisés
     */
    public function index(): AnonymousResourceCollection
    {
        $partners = Partner::query()->active()->ordered()->get();

        return PartnerResource::collection($partners);
    }

    /**
     * Retourne un partenaire actif identifié par son slug.
     *
     * @param  string  $slug  Slug du partenaire
     * @return JsonResource Partenaire sérialisé
     */
    public function show(string $slug): JsonResource
    {
        $partner = Partner::query()->active()->where('slug', $slug)->firstOrFail();

        return new PartnerResource($partner);
    }
}
