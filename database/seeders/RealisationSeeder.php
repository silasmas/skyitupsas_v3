<?php

namespace Database\Seeders;

use App\Models\Realisation;
use Illuminate\Database\Seeder;

class RealisationSeeder extends Seeder
{
    public function run(): void
    {
        Realisation::factory(6)->create();
    }
}
