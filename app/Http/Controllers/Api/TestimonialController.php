<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Endpoints API des témoignages clients.
 */
class TestimonialController extends Controller
{
    /**
     * Liste les témoignages actifs triés pour l'affichage public.
     *
     * @return AnonymousResourceCollection Collection de témoignages
     */
    public function index(): AnonymousResourceCollection
    {
        $testimonials = Testimonial::query()->active()->ordered()->get();

        return TestimonialResource::collection($testimonials);
    }

    /**
     * Retourne un témoignage actif par slug.
     *
     * @param  string  $slug  Identifiant URL du témoignage
     * @return JsonResource Témoignage sérialisé
     */
    public function show(string $slug): JsonResource
    {
        $testimonial = Testimonial::query()->active()->where('slug', $slug)->firstOrFail();

        return new TestimonialResource($testimonial);
    }
}
