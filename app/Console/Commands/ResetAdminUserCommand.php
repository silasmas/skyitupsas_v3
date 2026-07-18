<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Réinitialise le compte administrateur Filament (mot de passe + rôle super_admin).
 *
 * Le mot de passe est écrit directement en base via Hash::make pour éviter
 * tout double hachage lié au cast « hashed » du modèle User.
 */
class ResetAdminUserCommand extends Command
{
    /** @var string */
    protected $signature = 'app:reset-admin
                            {--email=admin@skyitupsas.org : E-mail de connexion admin}
                            {--password= : Mot de passe en clair (sinon ADMIN_PASSWORD ou valeur par défaut)}
                            {--name=Administrateur : Nom affiché}
                            {--force : Exécuter sans confirmation}';

    /** @var string */
    protected $description = 'Réinitialise le compte admin Filament et vérifie la connexion';

    /**
     * Exécute la réinitialisation du compte admin.
     *
     * @return int Code de sortie (0 = succès)
     */
    public function handle(): int
    {
        $email = (string) $this->option('email');
        $password = (string) ($this->option('password')
          ?: env('ADMIN_PASSWORD', 'SkyITup2026!Admin'));
        $name = (string) $this->option('name');

        if (! $this->option('force') && ! $this->confirm("Réinitialiser l'admin « {$email} » ?", true)) {
            $this->warn('Opération annulée.');

            return self::FAILURE;
        }

        $superAdminRole = config('filament-shield.super_admin.name', 'super_admin');
        $panelUserRole = config('filament-shield.panel_user.name', 'panel_user');

        Role::findOrCreate($superAdminRole);
        Role::findOrCreate($panelUserRole);

        $now = now();
        $userId = DB::table('users')->where('email', $email)->value('id');

        if ($userId) {
            DB::table('users')->where('id', $userId)->update([
                'name' => $name,
                'password' => Hash::make($password),
                'email_verified_at' => $now,
                'updated_at' => $now,
            ]);
        } else {
            $userId = DB::table('users')->insertGetId([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $user = User::query()->findOrFail($userId);
        $user->syncRoles([$superAdminRole, $panelUserRole]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $hashOk = Hash::check($password, (string) $user->password);
        $authOk = Auth::attempt(['email' => $email, 'password' => $password], false);

        Auth::logout();

        $this->info("Admin mis à jour : {$email} (id {$user->id})");
        $this->line('Vérification hash : '.($hashOk ? 'OK' : 'ÉCHEC'));
        $this->line('Vérification Auth::attempt : '.($authOk ? 'OK' : 'ÉCHEC'));

        User::query()->orderBy('id')->get(['id', 'email', 'name'])->each(function (User $row): void {
            $this->line("  - #{$row->id} {$row->email} ({$row->name})");
        });

        if (! $hashOk || ! $authOk) {
            $this->error('La réinitialisation a échoué — mot de passe non valide en base.');

            return self::FAILURE;
        }

        $this->info('Compte admin prêt pour la connexion Filament.');

        return self::SUCCESS;
    }
}
