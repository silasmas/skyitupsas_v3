<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['slug' => 'partenaire-1', 'fr' => 'Partenaire stratégique', 'en' => 'Strategic partner', 'logo' => 'partners/partner-1.png', 'sort' => 1],
            ['slug' => 'partenaire-2', 'fr' => 'Partenaire technologique', 'en' => 'Technology partner', 'logo' => 'partners/partner-2.png', 'sort' => 2],
            ['slug' => 'partenaire-3', 'fr' => 'Partenaire cloud', 'en' => 'Cloud partner', 'logo' => 'partners/partner-3.png', 'sort' => 3],
            ['slug' => 'partenaire-4', 'fr' => 'Partenaire sécurité', 'en' => 'Security partner', 'logo' => 'partners/partner-4.png', 'sort' => 4],
            ['slug' => 'partenaire-5', 'fr' => 'Partenaire réseau', 'en' => 'Network partner', 'logo' => 'partners/partner-5.png', 'sort' => 5],
            ['slug' => 'partenaire-6', 'fr' => 'Partenaire solutions', 'en' => 'Solutions partner', 'logo' => 'partners/partner-6.png', 'sort' => 6],
        ];

        foreach ($rows as $row) {
            Partner::updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'name' => ['fr' => $row['fr'], 'en' => $row['en']],
                    'website_url' => null,
                    'logo' => file_exists(public_path('assets/img/'.$row['logo'])) ? $row['logo'] : null,
                    'sort_order' => $row['sort'],
                    'open_in_new_tab' => true,
                    'is_active' => true,
                ]
            );
        }
    }
}
