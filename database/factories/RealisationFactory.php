<?php

namespace Database\Factories;

use App\Models\Realisation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RealisationFactory extends Factory
{
    protected $model = Realisation::class;

    public function definition(): array
    {
        $title = fake()->words(4, true);

        return [
            'slug' => Str::slug($title),
            'title' => ['fr' => $title, 'en' => $title],
            'description' => ['fr' => fake()->paragraph(), 'en' => fake()->paragraph()],
            'content' => ['fr' => fake()->paragraphs(3, true), 'en' => fake()->paragraphs(3, true)],
            'meta_description' => ['fr' => fake()->sentence(), 'en' => fake()->sentence()],
            'featured_image' => null,
            'client' => fake()->company(),
            'project_date' => fake()->dateTimeBetween('-2 years'),
            'project_url' => fake()->optional()->url(),
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
