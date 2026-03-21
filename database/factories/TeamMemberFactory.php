<?php

namespace Database\Factories;

use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeamMemberFactory extends Factory
{
    protected $model = TeamMember::class;

    public function definition(): array
    {
        $name = fake()->name();

        return [
            'slug' => Str::slug($name),
            'picture' => 'assets/img/team/member-' . fake()->numberBetween(1, 4) . '.jpg',
            'facebook' => fake()->optional()->url(),
            'twitter' => fake()->optional()->url(),
            'instagram' => fake()->optional()->url(),
            'linkedin' => fake()->optional()->url(),
            'name' => ['fr' => $name, 'en' => $name],
            'role' => ['fr' => fake()->jobTitle(), 'en' => fake()->jobTitle()],
            'assets' => [
                'fr' => [['asset1' => fake()->paragraph(), 'asset2' => fake()->paragraph(), 'asset3' => '', 'asset4' => []]],
                'en' => [['asset1' => fake()->paragraph(), 'asset2' => fake()->paragraph(), 'asset3' => '', 'asset4' => []]],
            ],
            'experience' => [
                'fr' => [['company' => fake()->company(), 'role' => fake()->jobTitle(), 'tasks' => null]],
                'en' => [['company' => fake()->company(), 'role' => fake()->jobTitle(), 'tasks' => null]],
            ],
            'diplomas' => [
                'fr' => [['diploma' => fake()->sentence()]],
                'en' => [['diploma' => fake()->sentence()]],
            ],
            'expertises' => [
                'fr' => [['expertise' => fake()->word()]],
                'en' => [['expertise' => fake()->word()]],
            ],
            'work_countries' => [
                'fr' => [['region' => 'Afrique', 'countries' => fake()->country()]],
                'en' => [['region' => 'Africa', 'countries' => fake()->country()]],
            ],
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
