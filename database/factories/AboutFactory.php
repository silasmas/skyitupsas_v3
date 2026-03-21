<?php

namespace Database\Factories;

use App\Models\About;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AboutFactory extends Factory
{
    protected $model = About::class;

    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'slug' => Str::slug($title),
            'title' => ['fr' => $title, 'en' => $title],
            'subtitle' => ['fr' => fake()->sentence(), 'en' => fake()->sentence()],
            'big_title' => ['fr' => 'À propos de nous', 'en' => 'About us'],
            'big_title_1' => ['fr' => 'À propos de', 'en' => 'About'],
            'big_title_2' => ['fr' => 'nous', 'en' => 'us'],
            'welcome_title_1' => ['fr' => 'Bienvenue chez', 'en' => 'Welcome to'],
            'welcome_title_2' => ['fr' => 'notre', 'en' => 'our'],
            'content' => ['fr' => fake()->paragraphs(3, true), 'en' => fake()->paragraphs(3, true)],
            'experience_label' => ['fr' => 'Expérience antérieure', 'en' => 'Previous experience'],
            'diploma_label' => ['fr' => 'Diplôme et formation', 'en' => 'Diploma and training'],
            'expertise_label' => ['fr' => 'Expertise', 'en' => 'Expertise'],
            'work_countries_label' => ['fr' => 'Pays de travail', 'en' => 'Countries of work'],
            'content1' => [
                'fr' => 'SKYITUP une Entreprise de Services du Numérique, basée à Kinshasa, fondée et dirigée par une équipe de professionnels possédant une longue expérience dans le leadership international.',
                'en' => 'SKYITUP a Digital Services Company, based in Kinshasa, founded and managed by a team of professionals with long experience in international leadership.',
            ],
            'content2' => [
                'fr' => 'Nous offrons et fournissons un portefeuille bien riche de solutions Intelligentes adaptées à l\'environnement socio-économique.',
                'en' => 'We offer and provide a rich portfolio of Intelligent solutions adapted to the socio-economic environment.',
            ],
            'meta_description' => ['fr' => fake()->sentence(), 'en' => fake()->sentence()],
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
