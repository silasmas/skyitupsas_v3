<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Partner>
 */
class PartnerFactory extends Factory
{
    protected $model = Partner::class;

    public function definition(): array
    {
        $name = fake()->company();

        return [
            'slug' => Str::slug($name.'-'.fake()->unique()->numerify('###')),
            'name' => ['fr' => $name, 'en' => $name],
            'website_url' => fake()->optional(0.6)->url(),
            'logo' => null,
            'sort_order' => fake()->numberBetween(0, 50),
            'open_in_new_tab' => true,
            'is_active' => true,
        ];
    }
}
