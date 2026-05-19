<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::updateOrCreate(
            ['slug' => 'contact'],
            [
                'slug' => 'contact',
                'title' => ['fr' => 'Contactez-nous', 'en' => 'Contact us'],
                'description' => [
                    'fr' => 'N\'hésitez pas à nous contacter pour toute question ou demande.',
                    'en' => 'Do not hesitate to contact us for any questions or requests.',
                ],
                'address' => [
                    'fr' => 'Siège social : 25, Avenue de l’Équateur, Commune de la Gombe — Immeuble MK Tower, 2e niveau, local 202. Présence : Lubumbashi, Goma, Bukavu.',
                    'en' => 'Head office: 25 Avenue de l’Équateur, Gombe — MK Tower, 2nd floor, office 202. Presence: Lubumbashi, Goma, Bukavu.',
                ],
                'meta_description' => [
                    'fr' => 'Contactez Skyitupsas',
                    'en' => 'Contact Skyitupsas',
                ],
                'email' => 'contact@skyitupsas.com',
                'phone' => '(+243) 821 790 718',
                'sort_order' => 0,
                'is_active' => true,
            ]
        );
    }
}
