<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'slug' => Str::slug($title),
            'title' => ['fr' => $title, 'en' => $title],
            'excerpt' => ['fr' => fake()->paragraph(), 'en' => fake()->paragraph()],
            'content' => ['fr' => fake()->paragraphs(5, true), 'en' => fake()->paragraphs(5, true)],
            'meta_description' => ['fr' => fake()->sentence(), 'en' => fake()->sentence()],
            'featured_image' => null,
            'published_at' => fake()->optional()->dateTimeBetween('-1 year'),
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
