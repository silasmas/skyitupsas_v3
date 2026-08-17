<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SiteSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Recherche instantanée sur le contenu public du site.
     *
     * La locale est résolue par le middleware `locale` (query `?locale=`
     * ou header `X-Locale`).
     *
     * @param  Request  $request  Requête HTTP (paramètre `q`)
     * @param  SiteSearchService  $searchService  Service de recherche
     * @return JsonResponse Résultats normalisés
     */
    public function index(Request $request, SiteSearchService $searchService): JsonResponse
    {
        $query = (string) $request->query('q', '');
        $results = $searchService->search($query, app()->getLocale(), 12);

        return response()->json([
            'query' => $query,
            'results' => $results,
        ]);
    }
}
