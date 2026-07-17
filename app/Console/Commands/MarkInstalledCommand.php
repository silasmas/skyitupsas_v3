<?php

namespace App\Console\Commands;

use App\Services\InstallService;
use Illuminate\Console\Command;

/**
 * Marque l'application comme installée (écrit le fichier de verrou).
 *
 * Utile pour les environnements existants avant l'introduction du wizard,
 * afin d'éviter une redirection forcée vers `/install`.
 */
class MarkInstalledCommand extends Command
{
    /** @var string */
    protected $signature = 'app:mark-installed';

    /** @var string */
    protected $description = 'Écrit storage/app/installed pour verrouiller le wizard d\'installation';

    /**
     * Exécute la commande.
     *
     * @param  InstallService  $installer  Service d'installation
     * @return int Code de sortie
     */
    public function handle(InstallService $installer): int
    {
        if ($installer->isInstalled()) {
            $this->info('L\'application est déjà marquée comme installée.');

            return self::SUCCESS;
        }

        $installer->finalize();
        $this->info('Fichier de verrou créé : '.$installer->lockPath());

        return self::SUCCESS;
    }
}
