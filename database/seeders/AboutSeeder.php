<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        $fr = require resource_path('lang/fr/info.php');
        $en = require resource_path('lang/en/info.php');
        $aboutFr = $fr['about'];
        $aboutEn = $en['about'];

        About::updateOrCreate(
            ['slug' => 'a-propos'],
            [
                'slug' => 'a-propos',
                'title' => [
                    'fr' => $aboutFr['big_title'],
                    'en' => $aboutEn['big_title'],
                ],
                'subtitle' => [
                    'fr' => $aboutFr['welcome_title_1'] . ' ' . $aboutFr['welcome_title_2'],
                    'en' => $aboutEn['welcome_title_1'] . ' ' . $aboutEn['welcome_title_2'],
                ],
                'big_title' => [
                    'fr' => $aboutFr['big_title'],
                    'en' => $aboutEn['big_title'],
                ],
                'big_title_1' => [
                    'fr' => $aboutFr['big_title_1'],
                    'en' => $aboutEn['big_title_1'],
                ],
                'big_title_2' => [
                    'fr' => $aboutFr['big_title_2'],
                    'en' => $aboutEn['big_title_2'],
                ],
                'welcome_title_1' => [
                    'fr' => $aboutFr['welcome_title_1'],
                    'en' => $aboutEn['welcome_title_1'],
                ],
                'welcome_title_2' => [
                    'fr' => $aboutFr['welcome_title_2'],
                    'en' => $aboutEn['welcome_title_2'],
                ],
                'experience_label' => [
                    'fr' => $aboutFr['experience'],
                    'en' => $aboutEn['experience'],
                ],
                'diploma_label' => [
                    'fr' => $aboutFr['diploma'],
                    'en' => $aboutEn['diploma'],
                ],
                'expertise_label' => [
                    'fr' => $aboutFr['expertise'],
                    'en' => $aboutEn['expertise'],
                ],
                'work_countries_label' => [
                    'fr' => $aboutFr['work_countries'],
                    'en' => $aboutEn['work_countries'],
                ],
                'content1' => [
                    'fr' => $aboutFr['about_content1'],
                    'en' => $aboutEn['about_content1'],
                ],
                'content2' => [
                    'fr' => $aboutFr['about_content2'],
                    'en' => $aboutEn['about_content2'],
                ],
                'content' => [
                    'fr' => $aboutFr['about_content1'] . "\n\n" . $aboutFr['about_content2'],
                    'en' => $aboutEn['about_content1'] . "\n\n" . $aboutEn['about_content2'],
                ],
                'meta_description' => [
                    'fr' => $aboutFr['about_content1'],
                    'en' => $aboutEn['about_content1'],
                ],
                'sort_order' => 0,
                'is_active' => true,
            ]
        );
    }
}
