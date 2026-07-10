<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobOfferResource;
use App\Models\JobOffer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class JobOfferController extends Controller
{
    /**
     * Liste les offres d'emploi publiées et ouvertes.
     *
     * @return AnonymousResourceCollection Collection d'offres sérialisées
     */
    public function index(): AnonymousResourceCollection
    {
        $offers = JobOffer::query()->publishedForPublic()->ordered()->get();

        return JobOfferResource::collection($offers);
    }

    /**
     * Retourne une offre publiée identifiée par son slug.
     *
     * @param  string  $slug  Slug de l'offre
     * @return JsonResource Offre sérialisée
     */
    public function show(string $slug): JsonResource
    {
        $offer = JobOffer::query()
            ->where('slug', $slug)
            ->publishedForPublic()
            ->firstOrFail();

        return new JobOfferResource($offer);
    }
}
