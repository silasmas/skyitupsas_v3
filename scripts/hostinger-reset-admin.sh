#!/usr/bin/env bash
# Réinitialise le compte admin (mot de passe en clair — cast hashed du modèle User)
# et synchronise AdminPanelProvider (logo login Filament).
set -uo pipefail

ADMIN="${ADMIN_DIR:-/home/u514199474/domains/skyitupsas.org/public_html/admin}"
LOG="${ADMIN_RESET_LOG:-/home/u514199474/domains/skyitupsas.org/admin-reset.log}"
REPO_RAW="https://raw.githubusercontent.com/silasmas/skyitupsas_v3/backend"
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

cd "$ADMIN" || exit 1

log "Mise à jour AdminPanelProvider.php (logo login)..."
curl -fsSL -o app/Providers/Filament/AdminPanelProvider.php \
  "$REPO_RAW/app/Providers/Filament/AdminPanelProvider.php"

log "Réinitialisation du compte admin ${ADMIN_EMAIL}..."
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
echo "Admin réinitialisé : {\$email}\n";
PHP

log "Rechargement des caches..."
"$PHP_BIN" artisan optimize:clear >> "$LOG" 2>&1 || true
"$PHP_BIN" artisan optimize >> "$LOG" 2>&1 || true

log "=== Réinitialisation admin terminée ==="
exit 0
