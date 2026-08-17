<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServicePillarResource;
use App\Models\ServicePillar;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * API des piliers stratégiques de services (avec modules imbriqués).
 */
class ServicePillarController extends Controller
{
    /**
     * Liste les piliers actifs avec leurs modules actifs.
     *
     * @return AnonymousResourceCollection Collection de piliers
     */
    public function index(): AnonymousResourceCollection
    {
        $pillars = ServicePillar::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->with(['modules' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order')])
            ->get();

        return ServicePillarResource::collection($pillars);
    }

    /**
     * Détail d'un pilier actif par slug.
     *
     * @param  string  $slug  Slug du pilier
     * @return ServicePillarResource Pilier sérialisé
     */
    public function show(string $slug): ServicePillarResource
    {
        $pillar = ServicePillar::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with(['modules' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order')])
            ->firstOrFail();

        return new ServicePillarResource($pillar);
    }
}
