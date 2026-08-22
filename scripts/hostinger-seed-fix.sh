#!/usr/bin/env bash
# Met à jour BlogSeeder, exécute les seeders et finalise l'installation (cron Hostinger).
set -uo pipefail

ADMIN="${ADMIN_DIR:-/home/u514199474/domains/skyitupsas.org/public_html/admin}"
LOG="${SEED_LOG:-/home/u514199474/domains/skyitupsas.org/seed-fix.log}"
REPO_RAW="https://raw.githubusercontent.com/silasmas/skyitupsas_v3/main"
ADMIN_EMAIL="${ADMIN_EMAIL:-admin@skyitupsas.org}"
ADMIN_PASS="${ADMIN_PASS:-SkyITup2026!Admin}"

log() {
  echo "[$(date -u +%Y-%m-%dT%H:%M:%SZ)] $*" | tee -a "$LOG"
}

phpBin() {
  for candidate in \
    /opt/alt/php83/usr/bin/php \
    /opt/alt/php84/usr/bin/php \
    /usr/bin/php83 \
    php; do
    if [[ -x "$candidate" ]]; then
      echo "$candidate"
      return
    fi
  done
  echo "php"
}

PHP_BIN="$(phpBin)"

if [[ ! -f "$ADMIN/artisan" ]]; then
  log "ERREUR: artisan introuvable dans $ADMIN"
  exit 1
fi

cd "$ADMIN" || exit 1

log "Mise à jour BlogSeeder.php depuis GitHub..."
curl -fsSL -o database/seeders/BlogSeeder.php "$REPO_RAW/database/seeders/BlogSeeder.php"

log "Exécution db:seed --force..."
"$PHP_BIN" artisan db:seed --force >> "$LOG" 2>&1 || {
  log "ÉCHEC db:seed — voir le log."
  exit 1
}

log "Seeders terminés."

if [[ ! -f storage/app/installed ]]; then
  log "Création compte admin et verrou installation..."
  "$PHP_BIN" <<PHP >> "$LOG" 2>&1
<?php
require __DIR__ . '/vendor/autoload.php';
\$app = require __DIR__ . '/bootstrap/app.php';
\$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
\$email = '${ADMIN_EMAIL}';
\$password = '${ADMIN_PASS}';
\$role = Spatie\Permission\Models\Role::findOrCreate('super_admin');
\$user = App\Models\User::updateOrCreate(
    ['email' => \$email],
    [
        'name' => 'Administrateur',
        'password' => \$password,
        'email_verified_at' => now(),
    ]
);
\$user->syncRoles([\$role->name]);
echo "Admin créé : {\$email}\n";
PHP
  "$PHP_BIN" artisan app:mark-installed >> "$LOG" 2>&1
  "$PHP_BIN" artisan optimize >> "$LOG" 2>&1
  log "Installation finalisée."
else
  log "Application déjà verrouillée — seeders seulement."
fi

log "=== seed-fix terminé avec succès ==="
exit 0
