<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        $title = 'Contact';

        return [
            'slug' => 'contact',
            'title' => ['fr' => $title, 'en' => $title],
            'description' => ['fr' => fake()->paragraph(), 'en' => fake()->paragraph()],
            'address' => ['fr' => fake()->address(), 'en' => fake()->address()],
            'meta_description' => ['fr' => fake()->sentence(), 'en' => fake()->sentence()],
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'map_embed' => null,
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
