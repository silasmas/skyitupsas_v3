<?php

namespace App\Http\Controllers;

use App\Services\InstallService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Wizard d'installation web (paramètres, BDD, seeders, storage, Shield, admin).
 *
 * Accessible uniquement tant que `storage/app/installed` n'existe pas.
 */
class InstallController extends Controller
{
    /** Étapes du wizard, dans l'ordre. */
    private const STEPS = [
        'requirements' => 'Prérequis',
        'environment' => 'Configuration',
        'database' => 'Base de données',
        'finalize' => 'Finalisation',
        'complete' => 'Terminé',
    ];

    /**
     * @param  InstallService  $installer  Service d'installation
     */
    public function __construct(
        private readonly InstallService $installer
    ) {}

    /**
     * Affiche l'étape courante du wizard (ou redirige vers la première étape).
     *
     * @param  string|null  $step  Identifiant d'étape
     * @return View|RedirectResponse
     */
    public function index(?string $step = null): View|RedirectResponse
    {
        $step = $step ?: 'requirements';

        if (! array_key_exists($step, self::STEPS)) {
            return redirect()->route('install.index', ['step' => 'requirements']);
        }

        return match ($step) {
            'requirements' => $this->showRequirements(),
            'environment' => $this->showEnvironment(),
            'database' => $this->showDatabase(),
            'finalize' => $this->showFinalize(),
            'complete' => $this->showComplete(),
            default => redirect()->route('install.index', ['step' => 'requirements']),
        };
    }

    /**
     * Étape 1 — contrôle des prérequis serveur.
     *
     * @return View
     */
    protected function showRequirements(): View
    {
        $result = $this->installer->checkRequirements();

        return view('install.wizard', [
            'step' => 'requirements',
            'steps' => self::STEPS,
            'checks' => $result['checks'],
            'requirementsOk' => $result['ok'],
        ]);
    }

    /**
     * Étape 2 — formulaire des paramètres d'environnement.
     *
     * @return View
     */
    protected function showEnvironment(): View
    {
        return view('install.wizard', [
            'step' => 'environment',
            'steps' => self::STEPS,
            'values' => $this->installer->defaultEnvValues(),
        ]);
    }

    /**
     * Enregistre les paramètres `.env` puis passe à l'étape base de données.
     *
     * @param  Request  $request  Données du formulaire
     * @return RedirectResponse
     */
    public function saveEnvironment(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'APP_NAME' => ['required', 'string', 'max:100'],
            'APP_ENV' => ['required', 'in:production,local,staging'],
            'APP_DEBUG' => ['required', 'in:true,false'],
            'APP_URL' => ['required', 'url', 'max:255'],
            'FRONTEND_URLS' => ['required', 'string', 'max:500'],
            'APP_LOCALE' => ['required', 'in:fr,en'],
            'DB_CONNECTION' => ['required', 'in:mysql,sqlite,pgsql'],
            'DB_HOST' => ['nullable', 'string', 'max:255'],
            'DB_PORT' => ['nullable', 'string', 'max:10'],
            'DB_DATABASE' => ['required', 'string', 'max:255'],
            'DB_USERNAME' => ['nullable', 'string', 'max:255'],
            'DB_PASSWORD' => ['nullable', 'string', 'max:255'],
            'MAIL_MAILER' => ['required', 'string', 'max:50'],
            'MAIL_HOST' => ['nullable', 'string', 'max:255'],
            'MAIL_PORT' => ['nullable', 'string', 'max:10'],
            'MAIL_USERNAME' => ['nullable', 'string', 'max:255'],
            'MAIL_PASSWORD' => ['nullable', 'string', 'max:255'],
            'MAIL_FROM_ADDRESS' => ['required', 'email', 'max:255'],
            'MAIL_FROM_NAME' => ['required', 'string', 'max:100'],
        ]);

        $dbTest = $this->installer->testDatabaseConnection([
            'connection' => $data['DB_CONNECTION'],
            'host' => $data['DB_HOST'] ?? '127.0.0.1',
            'port' => $data['DB_PORT'] ?? '3306',
            'database' => $data['DB_DATABASE'],
            'username' => $data['DB_USERNAME'] ?? '',
            'password' => $data['DB_PASSWORD'] ?? '',
        ]);

        if (! $dbTest['ok']) {
            return back()
                ->withInput()
                ->withErrors(['DB_DATABASE' => 'Connexion BDD échouée : '.$dbTest['message']]);
        }

        $env = array_merge($data, [
            'APP_FALLBACK_LOCALE' => $data['APP_LOCALE'] === 'fr' ? 'en' : 'fr',
            'SESSION_DRIVER' => 'database',
            'CACHE_STORE' => 'database',
            'QUEUE_CONNECTION' => 'database',
            'FILESYSTEM_DISK' => 'public',
            'LOG_LEVEL' => $data['APP_DEBUG'] === 'true' ? 'debug' : 'error',
        ]);

        try {
            $this->installer->writeEnvironment($env);
            $this->installer->reloadEnvironment();
        } catch (\Throwable $e) {
            return back()->withInput()->withErrors(['APP_NAME' => $e->getMessage()]);
        }

        return redirect()
            ->route('install.index', ['step' => 'database'])
            ->with('success', 'Configuration enregistrée. Connexion BDD validée.');
    }

    /**
     * Étape 3 — migrations + options seeders / storage / Shield.
     *
     * @return View
     */
    protected function showDatabase(): View
    {
        return view('install.wizard', [
            'step' => 'database',
            'steps' => self::STEPS,
            'seeders' => $this->installer->availableSeeders(),
        ]);
    }

    /**
     * Exécute migrations, seeders optionnels, storage:link et permissions Shield.
     *
     * @param  Request  $request  Options cochées
     * @return RedirectResponse
     */
    public function runDatabase(Request $request): RedirectResponse
    {
        $runSeeders = $request->boolean('run_seeders');

        $migrate = $this->installer->runMigrations();
        if (! $migrate['ok']) {
            return back()->withErrors(['install' => 'Migrations échouées : '.$migrate['output']]);
        }

        $logs = ['Migrations : OK'];

        if ($runSeeders) {
            $seed = $this->installer->runSeeders();
            if (! $seed['ok']) {
                return back()->withErrors(['install' => 'Seeders échoués : '.$seed['output']]);
            }
            $logs[] = 'Seeders : OK';
        } else {
            $logs[] = 'Seeders : ignorés';
        }

        $storage = $this->installer->createStorageLink();
        if (! $storage['ok']) {
            return back()->withErrors(['install' => 'storage:link échoué : '.$storage['output']]);
        }
        $logs[] = 'Storage link : OK';

        $shield = $this->installer->generateShieldPermissions();
        if (! $shield['ok']) {
            return back()->withErrors(['install' => 'Shield échoué : '.$shield['output']]);
        }
        $logs[] = 'Permissions Shield : OK';

        return redirect()
            ->route('install.index', ['step' => 'finalize'])
            ->with('success', implode(' · ', $logs));
    }

    /**
     * Étape 4 — création du compte administrateur.
     *
     * @return View
     */
    protected function showFinalize(): View
    {
        return view('install.wizard', [
            'step' => 'finalize',
            'steps' => self::STEPS,
        ]);
    }

    /**
     * Crée l'admin puis affiche l'écran de succès (le verrou est posé ensuite).
     *
     * @param  Request  $request  Données admin
     * @return RedirectResponse
     */
    public function finish(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $admin = $this->installer->createAdminUser(
            $data['name'],
            $data['email'],
            $data['password']
        );

        if (! $admin['ok']) {
            return back()->withInput()->withErrors(['email' => $admin['output']]);
        }

        return redirect()
            ->route('install.index', ['step' => 'complete'])
            ->with('admin_email', $data['email']);
    }

    /**
     * Étape finale — récapitulatif et liens admin / site.
     *
     * @return View
     */
    protected function showComplete(): View
    {
        return view('install.wizard', [
            'step' => 'complete',
            'steps' => self::STEPS,
            'adminEmail' => session('admin_email'),
        ]);
    }

    /**
     * Pose le fichier de verrou et redirige vers le panneau admin.
     *
     * @return RedirectResponse
     */
    public function lock(): RedirectResponse
    {
        $this->installer->finalize();

        return redirect('/admin')->with('status', 'Installation terminée. Connectez-vous avec votre compte administrateur.');
    }
}
