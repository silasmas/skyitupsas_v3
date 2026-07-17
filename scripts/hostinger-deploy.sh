#!/usr/bin/env bash
# Déploiement automatisé Laravel sur Hostinger (admin.skyitupsas.org).
# Appelé par cron : curl -fsSL .../hostinger-deploy.sh | bash
set -euo pipefail

ADMIN="${ADMIN_DIR:-/home/u514199474/domains/skyitupsas.org/public_html/admin}"
LOG="${DEPLOY_LOG:-/home/u514199474/domains/skyitupsas.org/deploy-backend.log}"
TMP="/tmp/skyitup-deploy-$$"
DB_PASS_FILE="${DB_PASS_FILE:-/home/u514199474/.skyitup_db_pass}"
ADMIN_EMAIL="${ADMIN_EMAIL:-admin@skyitupsas.org}"
ADMIN_PASS="${ADMIN_PASS:-SkyITup2026!Admin}"
REPO_TARBALL="https://codeload.github.com/silasmas/skyitupsas_v3/tar.gz/refs/heads/backend"

log() {
  echo "[$(date -u +%Y-%m-%dT%H:%M:%SZ)] $*" | tee -a "$LOG"
}

if [[ -f "$ADMIN/storage/app/installed" ]]; then
  log "Déjà installé — abandon."
  exit 0
fi

log "=== Déploiement backend SkyITup ==="
mkdir -p "$ADMIN"
rm -rf "$TMP"
mkdir -p "$TMP"

cd "$TMP"
log "Téléchargement archive GitHub..."
curl -fsSL -o backend.tgz "$REPO_TARBALL"
tar xzf backend.tgz
extractedDir="$(find "$TMP" -mindepth 1 -maxdepth 1 -type d | head -1)"
cp -a "$extractedDir"/. "$ADMIN/"
rm -rf "$TMP"

cd "$ADMIN"
log "Composer install..."
if command -v composer >/dev/null 2>&1; then
  composer install --no-dev --optimize-autoloader --no-interaction >> "$LOG" 2>&1
else
  /usr/local/bin/composer install --no-dev --optimize-autoloader --no-interaction >> "$LOG" 2>&1
fi

if [[ ! -f "$DB_PASS_FILE" ]]; then
  log "ERREUR: fichier mot de passe BDD absent ($DB_PASS_FILE)"
  exit 1
fi
dbPassword="$(cat "$DB_PASS_FILE")"

dbPassword="$(cat "$DB_PASS_FILE")"
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

log "Migrations..."
php artisan migrate --force >> "$LOG" 2>&1
log "Seeders..."
php artisan db:seed --force >> "$LOG" 2>&1
php artisan storage:link >> "$LOG" 2>&1 || true
php artisan shield:generate --all --option=permissions --no-interaction >> "$LOG" 2>&1

log "Création administrateur..."
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

log "=== Déploiement terminé ==="
