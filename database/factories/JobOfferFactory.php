<?php

namespace Database\Factories;

use App\Models\JobOffer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<JobOffer>
 */
class JobOfferFactory extends Factory
{
    protected $model = JobOffer::class;

    public function definition(): array
    {
        $titleFr = fake()->jobTitle();
        $titleEn = fake('en_US')->jobTitle();

        return [
            'slug' => Str::slug($titleFr.'-'.fake()->unique()->numerify('###')),
            'title' => ['fr' => $titleFr, 'en' => $titleEn],
            'description' => [
                'fr' => '<p>'.fake('fr_FR')->paragraph(4).'</p>',
                'en' => '<p>'.fake('en_US')->paragraph(4).'</p>',
            ],
            'requirements' => [
                'fr' => '<p>'.fake('fr_FR')->paragraph(2).'</p>',
                'en' => '<p>'.fake('en_US')->paragraph(2).'</p>',
            ],
            'location' => [
                'fr' => 'Kinshasa',
                'en' => 'Kinshasa',
            ],
            'contract_type' => fake()->randomElement(['cdi', 'cdd', 'stage', 'mission']),
            'published_at' => now()->subDays(fake()->numberBetween(1, 30)),
            'closes_at' => fake()->optional(0.5)->dateTimeBetween('now', '+3 months'),
            'sort_order' => fake()->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
