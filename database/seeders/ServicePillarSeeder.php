<?php

namespace Database\Seeders;

use App\Models\ServiceModule;
use App\Models\ServicePillar;
use Illuminate\Database\Seeder;

/**
 * Alimente les piliers stratégiques et modules de services (FR/EN).
 */
class ServicePillarSeeder extends Seeder
{
    /**
     * Exécute le seeder des piliers et modules.
     */
    public function run(): void
    {
        $pillars = require database_path('seeders/data/service_pillars.php');

        foreach ($pillars as $pillarData) {
            $modules = $pillarData['modules'] ?? [];
            unset($pillarData['modules']);

            $pillar = ServicePillar::query()->updateOrCreate(
                ['slug' => $pillarData['slug']],
                $pillarData
            );

            foreach ($modules as $moduleData) {
                $moduleData['service_pillar_id'] = $pillar->id;
                ServiceModule::query()->updateOrCreate(
                    ['slug' => $moduleData['slug']],
                    $moduleData
                );
            }
        }
    }
}
