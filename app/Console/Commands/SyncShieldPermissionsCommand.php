<?php

namespace App\Console\Commands;

use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

/**
 * Régénère les permissions Filament Shield et les attribue au rôle super_admin.
 *
 * À lancer en production après l'ajout d'une resource (ex. ServiceModule)
 * pour que le menu admin réapparaisse.
 */
class SyncShieldPermissionsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:sync-shield-permissions';

    /**
     * @var string
     */
    protected $description = 'Génère les permissions Shield manquantes et les donne au super_admin';

    /**
     * Exécute la synchronisation Shield.
     */
    public function handle(): int
    {
        try {
            $this->info('Génération des permissions Shield…');

            Artisan::call('shield:generate', [
                '--all' => true,
                '--option' => 'permissions',
                '--panel' => 'admin',
                '--no-interaction' => true,
            ]);

            $this->line(trim(Artisan::output()) ?: 'shield:generate OK');

            $roleName = Utils::getSuperAdminName();
            $role = Role::findOrCreate($roleName, config('auth.defaults.guard', 'web'));
            $permissions = Permission::query()->pluck('name')->all();

            if ($permissions !== []) {
                $role->syncPermissions($permissions);
            }

            Artisan::call('permission:cache-reset');

            $this->info(sprintf(
                'Rôle %s synchronisé (%d permissions).',
                $roleName,
                count($permissions)
            ));

            return self::SUCCESS;
        } catch (Throwable $exception) {
            $this->error($exception->getMessage());

            return self::FAILURE;
        }
    }
}
