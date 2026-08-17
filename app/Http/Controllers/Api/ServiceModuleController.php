<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceModuleResource;
use App\Models\ServiceModule;

/**
 * API des modules de services (détail par slug global).
 */
class ServiceModuleController extends Controller
{
    /**
     * Détail d'un module actif par slug.
     *
     * @param  string  $slug  Slug du module
     * @return ServiceModuleResource Module sérialisé avec pilier parent
     */
    public function show(string $slug): ServiceModuleResource
    {
        $module = ServiceModule::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with(['pillar' => fn ($query) => $query->where('is_active', true)])
            ->firstOrFail();

        return new ServiceModuleResource($module);
    }
}
