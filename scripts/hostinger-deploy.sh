#!/usr/bin/env bash
# Déploiement Laravel par étapes (compatible cron Hostinger : 1 commande, timeout court).
# Usage : bash /tmp/skyitup.sh   (chaque exécution avance d'une étape)
set -uo pipefail

ADMIN="${ADMIN_DIR:-/home/u514199474/domains/skyitupsas.org/public_html/admin}"
LOG="${DEPLOY_LOG:-/home/u514199474/domains/skyitupsas.org/deploy-backend.log}"
MARKER_DIR="$ADMIN/.deploy"
REPO_TARBALL="https://codeload.github.com/silasmas/skyitupsas_v3/tar.gz/refs/heads/backend"
ADMIN_EMAIL="${ADMIN_EMAIL:-admin@skyitupsas.org}"
ADMIN_PASS="${ADMIN_PASS:-SkyITup2026!Admin}"

log() {
  echo "[$(date -u +%Y-%m-%dT%H:%M:%SZ)] $*" | tee -a "$LOG"
}

mark() {
  mkdir -p "$MARKER_DIR"
  touch "$MARKER_DIR/$1"
}

done() {
  test -f "$MARKER_DIR/$1"
}

composerBin() {
  if command -v composer >/dev/null 2>&1; then
    echo "composer"
  else
    echo "/usr/local/bin/composer"
  fi
}

if [[ -f "$ADMIN/storage/app/installed" ]]; then
  log "Application déjà installée."
  exit 0
fi

mkdir -p "$ADMIN"
cd "$ADMIN" || exit 1

# Étape 1 — Téléchargement et extraction
if ! done "files"; then
  if [[ -f composer.json ]]; then
    log "Sources déjà présentes — étape 1 ignorée."
    mark "files"
  else
    log "Étape 1/5 — téléchargement sources..."
    rm -f index.html default.php 2>/dev/null || true
    TMP="/tmp/skyitup-deploy-$$"
    rm -rf "$TMP"
    mkdir -p "$TMP"
    cd "$TMP" || exit 1
    curl -fsSL -o backend.tgz "$REPO_TARBALL"
    tar xzf backend.tgz
    extractedDir="$(find "$TMP" -mindepth 1 -maxdepth 1 -type d | head -1)"
    cp -a "$extractedDir"/. "$ADMIN/"
    rm -rf "$TMP"
    mark "files"
    log "Étape 1/5 terminée."
    exit 0
  fi
fi

cd "$ADMIN" || exit 1

# Étape 2 — Composer
if ! done "vendor" && [[ ! -f vendor/autoload.php ]]; then
  log "Étape 2/5 — composer install..."
  COMPOSER_MEMORY_LIMIT=-1 COMPOSER_DISABLE_XDEBUG=1 $(composerBin) install \
    --no-dev --optimize-autoloader --no-interaction >> "$LOG" 2>&1 || exit 1
  mark "vendor"
  log "Étape 2/5 terminée."
  exit 0
fi

mark "vendor" 2>/dev/null || true

# Étape 3 — Configuration .env
if ! done "env"; then
  log "Étape 3/5 — configuration .env..."
  dbPassword="$(printf '%s' 'U2tZMXRUdXBfVjNfMjAyNiFPcmc=' | base64 -d)"
  export DB_PASS="$dbPassword"
  cp -n .env.example .env 2>/dev/null || cp .env.example .env
  php artisan key:generate --force >> "$LOG" 2>&1
  perl -pi -e '
    s/^APP_ENV=.*/APP_ENV=production/;
    s/^APP_DEBUG=.*/APP_DEBUG=false/;
    s|^APP_URL=.*|APP_URL=https://admin.skyitupsas.org|;
    s|^FRONTEND_URLS=.*|FRONTEND_URLS=https://skyitupsas.org,https://www.skyitupsas.org|;
    s/^DB_CONNECTION=.*/DB_CONNECTION=mysql/;
    s/^# DB_HOST=.*/DB_HOST=127.0.0.1/;
    s/^# DB_PORT=.*/DB_PORT=3306/;
    s/^# DB_DATABASE=.*/DB_DATABASE=u514199474_skyitup_v3/;
    s/^# DB_USERNAME=.*/DB_USERNAME=u514199474_skyitup_v3/;
    s/^# DB_PASSWORD=.*/DB_PASSWORD=$ENV{DB_PASS}/;
    s/^DB_PASSWORD=.*/DB_PASSWORD=$ENV{DB_PASS}/;
    s/^FILESYSTEM_DISK=.*/FILESYSTEM_DISK=public/;
    s/^LOG_LEVEL=.*/LOG_LEVEL=error/;
  ' .env
  printf '%s\n' \
    '<IfModule mod_rewrite.c>' \
    'RewriteEngine On' \
    'RewriteRule ^(.*)$ public/$1 [L]' \
    '</IfModule>' > .htaccess
  chmod -R ug+rwx storage bootstrap/cache
  mark "env"
  log "Étape 3/5 terminée."
  exit 0
fi

# Étape 4 — Migrations et seeders
if ! done "database"; then
  log "Étape 4/5 — migrations et seeders..."
  php artisan migrate --force >> "$LOG" 2>&1 || exit 1
  php artisan db:seed --force >> "$LOG" 2>&1 || exit 1
  php artisan storage:link >> "$LOG" 2>&1 || true
  php artisan shield:generate --all --option=permissions --no-interaction >> "$LOG" 2>&1 || exit 1
  mark "database"
  log "Étape 4/5 terminée."
  exit 0
fi

# Étape 5 — Admin et verrou
if ! done "finished"; then
  log "Étape 5/5 — compte admin et finalisation..."
  php <<PHP >> "$LOG" 2>&1
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
        'password' => Illuminate\Support\Facades\Hash::make(\$password),
        'email_verified_at' => now(),
    ]
);
\$user->syncRoles([\$role->name]);
echo "Admin créé : {\$email}\n";
PHP
  php artisan app:mark-installed >> "$LOG" 2>&1
  php artisan optimize >> "$LOG" 2>&1
  mark "finished"
  log "=== Déploiement terminé avec succès ==="
  exit 0
fi

log "Aucune étape en attente."
