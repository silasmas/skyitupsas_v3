<?php

/**
 * Réinitialisation d'urgence du compte admin (one-shot, supprimer après usage).
 *
 * Appel : GET /emergency-reset.php?s=v3hr7-reset-admin
 * Protégé par un secret fixe temporaire — ne pas laisser en production.
 */
declare(strict_types=1);

const RESET_SECRET = 'v3hr7-reset-admin';

if (! hash_equals(RESET_SECRET, (string) ($_GET['s'] ?? ''))) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    exit('Forbidden');
}

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

header('Content-Type: text/plain; charset=utf-8');

$email = 'admin@skyitupsas.org';
$password = 'SkyITup2026!Admin';
$name = 'Administrateur';
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

$hashOk = Hash::check($password, (string) DB::table('users')->where('id', $userId)->value('password'));
$authOk = Auth::attempt(['email' => $email, 'password' => $password], false);
Auth::logout();

echo "Admin: {$email}\n";
echo 'Hash::check: '.($hashOk ? 'OK' : 'FAIL')."\n";
echo 'Auth::attempt: '.($authOk ? 'OK' : 'FAIL')."\n";

foreach (DB::table('users')->orderBy('id')->get(['id', 'email']) as $row) {
    echo "User #{$row->id}: {$row->email}\n";
}

exit($hashOk && $authOk ? 0 : 1);
