<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Compte de démo local uniquement — en production l'admin est créé par /install.
        if (! app()->environment('production')) {
            User::firstOrCreate(
                ['email' => 'test@example.com'],
                User::factory()->make(['name' => 'Test User', 'email' => 'test@example.com'])->toArray()
            );
        }

        $this->call([
            TeamMemberSeeder::class,
            AboutSeeder::class,
            ServiceSeeder::class,
            BlogSeeder::class,
            NewsSeeder::class,
            ContactSeeder::class,
            RealisationSeeder::class,
            PartnerSeeder::class,
            JobOfferSeeder::class,
        ]);
    }
}
