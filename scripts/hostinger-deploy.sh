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

is_done() {
  test -f "$MARKER_DIR/$1"
}

composerBin() {
  if command -v composer >/dev/null 2>&1; then
    echo "composer"
  else
    echo "/usr/local/bin/composer"
  fi
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

if [[ -f "$ADMIN/storage/app/installed" ]]; then
  log "Application déjà installée."
  exit 0
fi

mkdir -p "$ADMIN"
cd "$ADMIN" || exit 1

# Étape 1 — Téléchargement et extraction
if ! is_done "files"; then
  if [[ -f composer.json ]]; then
    log "Sources déjà présentes — étape 1 ignorée."
    rm -f index.html default.php 2>/dev/null || true
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

# Étape 2 — Composer (arrière-plan : le cron Hostinger coupe les jobs longs)
if ! is_done "vendor" && [[ ! -f vendor/autoload.php ]]; then
  if [[ -f "$MARKER_DIR/composer_started" ]]; then
    log "Étape 2/5 — composer en cours (attente)..."
    exit 0
  fi
  log "Étape 2/5 — lancement composer install en arrière-plan..."
  cBin="$(composerBin)"
  nohup bash -c "cd '$ADMIN' && COMPOSER_MEMORY_LIMIT=-1 COMPOSER_DISABLE_XDEBUG=1 '$cBin' install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-progress >> '$LOG' 2>&1 && touch '$MARKER_DIR/vendor'" >> "$LOG" 2>&1 &
  mark "composer_started"
  exit 0
fi

if [[ -f vendor/autoload.php ]] && ! is_done "vendor"; then
  mark "vendor"
  log "Étape 2/5 terminée (vendor prêt)."
  exit 0
fi

# Étape 3 — Configuration .env
if is_done "env" && [[ -f .env ]] && grep -q '^DB_CONNECTION=sqlite' .env; then
  rm -f "$MARKER_DIR/env"
fi

if ! is_done "env"; then
  log "Étape 3/5 — configuration .env..."
  dbPassword="$(printf '%s' 'U2tZMXRUdXBfVjNfMjAyNiFPcmc=' | base64 -d)"
  cp .env.example .env
  "$PHP_BIN" artisan key:generate --force >> "$LOG" 2>&1
  cat > .env <<EOF
APP_NAME="SkyITup SAS"
APP_ENV=production
APP_KEY=$(grep '^APP_KEY=' .env | cut -d= -f2-)
APP_DEBUG=false
APP_URL=https://admin.skyitupsas.org

APP_LOCALE=fr
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=fr_FR

FRONTEND_URLS=https://skyitupsas.org,https://www.skyitupsas.org

APP_MAINTENANCE_DRIVER=file

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u514199474_skyitup_v3
DB_USERNAME=u514199474_skyitup_v3
DB_PASSWORD=${dbPassword}

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=public
QUEUE_CONNECTION=database

CACHE_STORE=database

MAIL_MAILER=log
MAIL_FROM_ADDRESS="contact@skyitupsas.org"
MAIL_FROM_NAME="SkyITup SAS"
EOF
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
if is_done "database" && ! "$PHP_BIN" artisan migrate:status >> "$LOG" 2>&1; then
  rm -f "$MARKER_DIR/database"
fi

if ! is_done "database"; then
  log "Étape 4/5 — migrations et seeders..."
  "$PHP_BIN" artisan migrate --force >> "$LOG" 2>&1 || exit 1
  "$PHP_BIN" artisan db:seed --force >> "$LOG" 2>&1 || exit 1
  "$PHP_BIN" artisan storage:link >> "$LOG" 2>&1 || true
  "$PHP_BIN" artisan shield:generate --all --option=permissions --no-interaction >> "$LOG" 2>&1 || exit 1
  mark "database"
  log "Étape 4/5 terminée."
  exit 0
fi

# Étape 5 — Admin et verrou
if ! is_done "finished"; then
  log "Étape 5/5 — compte admin et finalisation..."
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
        'password' => Illuminate\Support\Facades\Hash::make(\$password),
        'email_verified_at' => now(),
    ]
);
\$user->syncRoles([\$role->name]);
echo "Admin créé : {\$email}\n";
PHP
  "$PHP_BIN" artisan app:mark-installed >> "$LOG" 2>&1
  "$PHP_BIN" artisan optimize >> "$LOG" 2>&1
  mark "finished"
  log "=== Déploiement terminé avec succès ==="
  exit 0
fi

log "Aucune étape en attente."
