<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $title = fake()->words(3, true);

        return [
            'slug' => Str::slug($title),
            'title' => ['fr' => $title, 'en' => $title],
            'subtitle' => ['fr' => fake()->sentence(), 'en' => fake()->sentence()],
            'description' => ['fr' => fake()->paragraph(), 'en' => fake()->paragraph()],
            'content' => [
                'fr' => ['content' => fake()->paragraphs(2, true)],
                'en' => ['content' => fake()->paragraphs(2, true)],
            ],
            'meta_description' => ['fr' => fake()->sentence(), 'en' => fake()->sentence()],
            'icon' => 'heroicon-o-cog-6-tooth',
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
