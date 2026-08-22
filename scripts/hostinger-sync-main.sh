#!/usr/bin/env bash
# Synchronise le code Laravel depuis la branche main (sans réinstaller l'app).
set -uo pipefail

ADMIN="${ADMIN_DIR:-/home/u514199474/domains/skyitupsas.org/public_html/admin}"
LOG="${SYNC_LOG:-/home/u514199474/domains/skyitupsas.org/sync-main.log}"
TARBALL="https://codeload.github.com/silasmas/skyitupsas_v3/tar.gz/refs/heads/main"
TMP="/tmp/skyitup-sync-$$"

log() {
  echo "[$(date -u +%Y-%m-%dT%H:%M:%SZ)] $*" | tee -a "$LOG"
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
COMPOSER_BIN="$(composerBin)"

cd "$ADMIN" || exit 1

log "Téléchargement branche main..."
mkdir -p "$TMP"
curl -fsSL "$TARBALL" | tar -xz -C "$TMP" --strip-components=1

if [[ -f "$ADMIN/.env" ]]; then
  cp "$ADMIN/.env" "$TMP/.env.production.backup"
fi

log "Synchronisation des sources (préservation .env et storage/)..."
cp -a "$TMP"/. "$ADMIN/"

if [[ -f "$TMP/.env.production.backup" ]]; then
  cp "$TMP/.env.production.backup" "$ADMIN/.env"
fi

rm -rf "$TMP"

log "Composer install..."
HOME="$ADMIN" COMPOSER_HOME="$ADMIN/.composer" "$COMPOSER_BIN" install \
  --no-dev --optimize-autoloader --no-interaction >> "$LOG" 2>&1 || exit 1

log "Migrations..."
"$PHP_BIN" artisan migrate --force >> "$LOG" 2>&1 || exit 1

log "Caches..."
"$PHP_BIN" artisan optimize:clear >> "$LOG" 2>&1 || true
"$PHP_BIN" artisan optimize >> "$LOG" 2>&1 || true

log "=== Sync main terminée ==="
exit 0
