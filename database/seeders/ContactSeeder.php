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
                'fr' => 'Kinshasa, République Démocratique du Congo',
                'en' => 'Kinshasa, Democratic Republic of Congo',
            ],
            'meta_description' => [
                'fr' => 'Contactez Skyitupsas',
                'en' => 'Contact Skyitupsas',
            ],
            'email' => 'contact@skyitupsas.com',
            'phone' => '+243 000 000 000',
            'sort_order' => 0,
            'is_active' => true,
            ]
        );
    }
}
