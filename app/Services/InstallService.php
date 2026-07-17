<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Throwable;

/**
 * Orchestre l'installation de l'application (env, BDD, seeders, storage, Shield).
 *
 * Le fichier `storage/app/installed` sert de verrou : dès qu'il existe,
 * le wizard `/install` est inaccessible et l'application est considérée prête.
 */
class InstallService
{
    /** Chemin relatif du fichier de verrouillage d'installation. */
    public const LOCK_RELATIVE = 'installed';

    /**
     * Indique si l'application a déjà été installée.
     *
     * Uniquement via le fichier de verrou `storage/app/installed` (volontaire) :
     * les seeders peuvent créer des utilisateurs sans clôturer le wizard.
     * Pour les environnements déjà en place, exécuter `php artisan app:mark-installed`.
     *
     * @return bool true si le fichier de verrou existe
     */
    public function isInstalled(): bool
    {
        return File::exists($this->lockPath());
    }

    /**
     * Chemin absolu du fichier de verrou.
     *
     * @return string
     */
    public function lockPath(): string
    {
        return storage_path('app/'.self::LOCK_RELATIVE);
    }

    /**
     * Vérifie les prérequis serveur (PHP, extensions, permissions d'écriture).
     *
     * @return array{ok: bool, checks: list<array{label: string, ok: bool, detail: string}>}
     */
    public function checkRequirements(): array
    {
        $checks = [];

        $phpOk = version_compare(PHP_VERSION, '8.3.0', '>=');
        $checks[] = [
            'label' => 'PHP ≥ 8.3',
            'ok' => $phpOk,
            'detail' => 'Version détectée : '.PHP_VERSION,
        ];

        foreach (['pdo', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json', 'fileinfo', 'curl', 'bcmath'] as $ext) {
            $loaded = extension_loaded($ext);
            $checks[] = [
                'label' => "Extension PHP « {$ext} »",
                'ok' => $loaded,
                'detail' => $loaded ? 'Chargée' : 'Manquante',
            ];
        }

        $pdoMysql = extension_loaded('pdo_mysql');
        $pdoSqlite = extension_loaded('pdo_sqlite');
        $checks[] = [
            'label' => 'Driver PDO (MySQL ou SQLite)',
            'ok' => $pdoMysql || $pdoSqlite,
            'detail' => $pdoMysql
                ? 'pdo_mysql disponible'
                : ($pdoSqlite ? 'pdo_sqlite disponible' : 'Aucun driver PDO adapté'),
        ];

        foreach ([
            'storage/app' => storage_path('app'),
            'storage/framework' => storage_path('framework'),
            'storage/logs' => storage_path('logs'),
            'bootstrap/cache' => base_path('bootstrap/cache'),
        ] as $label => $path) {
            $writable = is_dir($path) && is_writable($path);
            $checks[] = [
                'label' => "Écriture sur « {$label} »",
                'ok' => $writable,
                'detail' => $writable ? 'OK' : "Non accessible en écriture ({$path})",
            ];
        }

        $envWritable = ! File::exists(base_path('.env')) || is_writable(base_path('.env'));
        $checks[] = [
            'label' => 'Fichier .env accessible en écriture',
            'ok' => $envWritable,
            'detail' => $envWritable ? 'OK' : 'Impossible d\'écrire dans .env',
        ];

        $ok = collect($checks)->every(fn (array $check): bool => $check['ok']);

        return ['ok' => $ok, 'checks' => $checks];
    }

    /**
     * Écrit (ou met à jour) le fichier `.env` à partir des paramètres du wizard.
     *
     * @param  array<string, string|null>  $values  Couples clé → valeur
     * @return void
     *
     * @throws \RuntimeException Si le fichier .env ne peut pas être créé/écrit
     */
    public function writeEnvironment(array $values): void
    {
        $envPath = base_path('.env');

        if (! File::exists($envPath)) {
            $example = base_path('.env.example');
            if (! File::exists($example)) {
                throw new \RuntimeException('Fichier .env.example introuvable.');
            }
            File::copy($example, $envPath);
        }

        $content = File::get($envPath);

        if (empty($values['APP_KEY'] ?? null) && ! preg_match('/^APP_KEY=.+/m', $content)) {
            $values['APP_KEY'] = 'base64:'.base64_encode(random_bytes(32));
        }

        foreach ($values as $key => $value) {
            if ($value === null) {
                continue;
            }
            $content = $this->setEnvValue($content, (string) $key, (string) $value);
        }

        File::put($envPath, $content);

        if (function_exists('opcache_invalidate')) {
            opcache_invalidate($envPath, true);
        }
    }

    /**
     * Remplace ou ajoute une clé dans le contenu `.env`.
     *
     * @param  string  $content  Contenu actuel
     * @param  string  $key  Nom de la variable
     * @param  string  $value  Valeur (sera échappée si nécessaire)
     * @return string Nouveau contenu
     */
    protected function setEnvValue(string $content, string $key, string $value): string
    {
        $escaped = $this->escapeEnvValue($value);
        $line = "{$key}={$escaped}";
        $pattern = "/^{$key}=.*$/m";

        if (preg_match($pattern, $content)) {
            return (string) preg_replace($pattern, $line, $content);
        }

        return rtrim($content).PHP_EOL.$line.PHP_EOL;
    }

    /**
     * Échappe une valeur pour le format `.env`.
     *
     * @param  string  $value  Valeur brute
     * @return string Valeur prête à écrire
     */
    protected function escapeEnvValue(string $value): string
    {
        if ($value === '') {
            return '';
        }

        if (preg_match('/[\s#"\'\\\\]/', $value)) {
            return '"'.str_replace(['\\', '"'], ['\\\\', '\\"'], $value).'"';
        }

        return $value;
    }

    /**
     * Recharge la config Laravel depuis le `.env` mis à jour (sans cache).
     *
     * @return void
     */
    public function reloadEnvironment(): void
    {
        if (File::exists(base_path('bootstrap/cache/config.php'))) {
            @unlink(base_path('bootstrap/cache/config.php'));
        }

        if (class_exists(\Dotenv\Dotenv::class) && method_exists(\Dotenv\Dotenv::class, 'createMutable')) {
            \Dotenv\Dotenv::createMutable(base_path())->load();
        }

        Artisan::call('config:clear');
    }

    /**
     * Teste la connexion à la base de données avec les paramètres fournis.
     *
     * @param  array{connection: string, host?: string, port?: string, database: string, username?: string, password?: string}  $db
     * @return array{ok: bool, message: string}
     */
    public function testDatabaseConnection(array $db): array
    {
        try {
            $connection = $db['connection'] ?? 'mysql';

            if ($connection === 'sqlite') {
                $database = $db['database'] ?: database_path('database.sqlite');
                if (! File::exists($database)) {
                    File::ensureDirectoryExists(dirname($database));
                    File::put($database, '');
                }
                config([
                    'database.default' => 'sqlite',
                    'database.connections.sqlite.database' => $database,
                ]);
            } else {
                config([
                    'database.default' => $connection,
                    "database.connections.{$connection}.host" => $db['host'] ?? '127.0.0.1',
                    "database.connections.{$connection}.port" => $db['port'] ?? '3306',
                    "database.connections.{$connection}.database" => $db['database'],
                    "database.connections.{$connection}.username" => $db['username'] ?? '',
                    "database.connections.{$connection}.password" => $db['password'] ?? '',
                ]);
            }

            DB::purge($connection === 'sqlite' ? 'sqlite' : $connection);
            DB::connection()->getPdo();
            DB::connection()->select('select 1');

            return ['ok' => true, 'message' => 'Connexion réussie.'];
        } catch (Throwable $e) {
            return ['ok' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Exécute les migrations (`migrate --force`).
     *
     * @return array{ok: bool, output: string}
     */
    public function runMigrations(): array
    {
        try {
            Artisan::call('migrate', ['--force' => true]);

            return ['ok' => true, 'output' => Artisan::output()];
        } catch (Throwable $e) {
            return ['ok' => false, 'output' => $e->getMessage()];
        }
    }

    /**
     * Exécute les seeders de démonstration (`db:seed --force`).
     *
     * @return array{ok: bool, output: string}
     */
    public function runSeeders(): array
    {
        try {
            Artisan::call('db:seed', ['--force' => true]);

            return ['ok' => true, 'output' => Artisan::output()];
        } catch (Throwable $e) {
            return ['ok' => false, 'output' => $e->getMessage()];
        }
    }

    /**
     * Crée le lien symbolique `public/storage` → `storage/app/public`.
     *
     * @return array{ok: bool, output: string}
     */
    public function createStorageLink(): array
    {
        try {
            if (File::exists(public_path('storage')) || is_link(public_path('storage'))) {
                return ['ok' => true, 'output' => 'Le lien storage existe déjà.'];
            }

            Artisan::call('storage:link');

            return ['ok' => true, 'output' => trim(Artisan::output()) ?: 'Lien storage créé.'];
        } catch (Throwable $e) {
            return ['ok' => false, 'output' => $e->getMessage()];
        }
    }

    /**
     * Génère les permissions/policies Filament Shield pour toutes les entités.
     *
     * @return array{ok: bool, output: string}
     */
    public function generateShieldPermissions(): array
    {
        try {
            Artisan::call('shield:generate', [
                '--all' => true,
                '--option' => 'permissions',
                '--no-interaction' => true,
            ]);

            $output = Artisan::output();

            // Garantit l'existence des rôles core même si le generate ne les crée pas.
            Role::findOrCreate(config('filament-shield.super_admin.name', 'super_admin'));
            Role::findOrCreate(config('filament-shield.panel_user.name', 'panel_user'));

            return ['ok' => true, 'output' => $output ?: 'Permissions Shield générées.'];
        } catch (Throwable $e) {
            return ['ok' => false, 'output' => $e->getMessage()];
        }
    }

    /**
     * Crée l'utilisateur administrateur et lui attribue le rôle super_admin.
     *
     * @param  string  $name  Nom affiché
     * @param  string  $email  E-mail de connexion
     * @param  string  $password  Mot de passe en clair
     * @return array{ok: bool, output: string, user?: User}
     */
    public function createAdminUser(string $name, string $email, string $password): array
    {
        try {
            $user = User::query()->updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make($password),
                    'email_verified_at' => now(),
                ]
            );

            $roleName = config('filament-shield.super_admin.name', 'super_admin');
            Role::findOrCreate($roleName);
            $user->syncRoles([$roleName]);

            return [
                'ok' => true,
                'output' => "Administrateur « {$email} » créé avec le rôle {$roleName}.",
                'user' => $user,
            ];
        } catch (Throwable $e) {
            return ['ok' => false, 'output' => $e->getMessage()];
        }
    }

    /**
     * Finalise l'installation : optimise les caches et écrit le fichier de verrou.
     *
     * @return void
     */
    public function finalize(): void
    {
        try {
            Artisan::call('optimize');
        } catch (Throwable) {
            // Non bloquant en environnement restreint.
        }

        File::ensureDirectoryExists(dirname($this->lockPath()));
        File::put($this->lockPath(), json_encode([
            'installed_at' => now()->toIso8601String(),
            'app_url' => config('app.url'),
            'version' => '1.0.0',
        ], JSON_PRETTY_PRINT));
    }

    /**
     * Valeurs par défaut proposées dans le formulaire d'environnement.
     *
     * @return array<string, string>
     */
    public function defaultEnvValues(): array
    {
        return [
            'APP_NAME' => env('APP_NAME', 'SkyITup SAS'),
            'APP_ENV' => 'production',
            'APP_DEBUG' => 'false',
            'APP_URL' => env('APP_URL', 'https://admin.skyitupsas.com'),
            'APP_LOCALE' => 'fr',
            'APP_FALLBACK_LOCALE' => 'en',
            'FRONTEND_URLS' => env('FRONTEND_URLS', 'https://skyitupsas.com,https://www.skyitupsas.com'),
            'DB_CONNECTION' => env('DB_CONNECTION', 'mysql'),
            'DB_HOST' => env('DB_HOST', '127.0.0.1'),
            'DB_PORT' => env('DB_PORT', '3306'),
            'DB_DATABASE' => env('DB_DATABASE', 'skyitupsas'),
            'DB_USERNAME' => env('DB_USERNAME', ''),
            'DB_PASSWORD' => env('DB_PASSWORD', ''),
            'MAIL_MAILER' => env('MAIL_MAILER', 'smtp'),
            'MAIL_HOST' => env('MAIL_HOST', ''),
            'MAIL_PORT' => env('MAIL_PORT', '587'),
            'MAIL_USERNAME' => env('MAIL_USERNAME', ''),
            'MAIL_PASSWORD' => env('MAIL_PASSWORD', ''),
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS', 'contact@skyitupsas.com'),
            'MAIL_FROM_NAME' => env('MAIL_FROM_NAME', 'SkyITup SAS'),
            'SESSION_DRIVER' => 'database',
            'CACHE_STORE' => 'database',
            'QUEUE_CONNECTION' => 'database',
            'FILESYSTEM_DISK' => 'public',
        ];
    }

    /**
     * Liste les seeders exécutés par DatabaseSeeder (affichage wizard).
     *
     * @return list<string>
     */
    public function availableSeeders(): array
    {
        return [
            'TeamMemberSeeder — équipe',
            'AboutSeeder — page À propos',
            'ServiceSeeder — services',
            'BlogSeeder — articles de blog',
            'NewsSeeder — actualités',
            'ContactSeeder — coordonnées',
            'RealisationSeeder — réalisations',
            'PartnerSeeder — partenaires',
            'JobOfferSeeder — offres d\'emploi',
        ];
    }
}
