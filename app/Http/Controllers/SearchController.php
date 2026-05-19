<?php

namespace App\Http\Controllers;

use App\Services\SiteSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Recherche asynchrone (JSON) pour l’en-tête du site.
     *
     * @param  string  $locale  Code langue
     */
    public function index(Request $request, string $locale, SiteSearchService $searchService): JsonResponse
    {
        $query = (string) $request->query('q', '');
        $results = $searchService->search($query, $locale, 12);

        return response()->json([
            'query' => $query,
            'results' => $results,
        ]);
    }
}
