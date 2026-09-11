#!/usr/bin/env bash
# Synchronise le code Laravel depuis la branche main (sans réinstaller l'app).
# Préserve .env et storage/ (médias, caches, lock d'installation).
set -uo pipefail

ADMIN="${ADMIN_DIR:-/home/u514199474/domains/skyitupsas.org/public_html/admin}"
LOG="${SYNC_LOG:-/home/u514199474/domains/skyitupsas.org/sync-main.log}"
TARBALL="https://codeload.github.com/silasmas/skyitupsas_v3/tar.gz/refs/heads/main"
TMP="/tmp/skyitup-sync-$$"
STORAGE_BACKUP="/tmp/skyitup-storage-backup-$$"

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

log "Sauvegarde .env et storage/..."
ENV_BACKUP=""
if [[ -f "$ADMIN/.env" ]]; then
  ENV_BACKUP="/tmp/skyitup-env-backup-$$"
  cp "$ADMIN/.env" "$ENV_BACKUP"
fi
if [[ -d "$ADMIN/storage" ]]; then
  rm -rf "$STORAGE_BACKUP"
  cp -a "$ADMIN/storage" "$STORAGE_BACKUP"
fi

log "Téléchargement branche main..."
rm -rf "$TMP"
mkdir -p "$TMP"
curl -fsSL "$TARBALL" | tar -xz -C "$TMP" --strip-components=1

log "Synchronisation des sources..."
rm -rf "$TMP/vendor" "$TMP/node_modules" "$TMP/.env" 2>/dev/null || true
cp -a "$TMP"/. "$ADMIN/"
rm -rf "$TMP"

if [[ -n "$ENV_BACKUP" && -f "$ENV_BACKUP" ]]; then
  cp "$ENV_BACKUP" "$ADMIN/.env"
  rm -f "$ENV_BACKUP"
fi
if [[ -d "$STORAGE_BACKUP" ]]; then
  rm -rf "$ADMIN/storage"
  mv "$STORAGE_BACKUP" "$ADMIN/storage"
fi

log "Composer install (PHP: $PHP_BIN)..."
HOME="$ADMIN" COMPOSER_HOME="$ADMIN/.composer" "$PHP_BIN" "$COMPOSER_BIN" install \
  --no-dev --optimize-autoloader --no-interaction >> "$LOG" 2>&1 || exit 1

log "Migrations..."
"$PHP_BIN" artisan migrate --force >> "$LOG" 2>&1 || exit 1

log "Caches..."
"$PHP_BIN" artisan optimize:clear >> "$LOG" 2>&1 || true
"$PHP_BIN" artisan optimize >> "$LOG" 2>&1 || true

log "=== Sync main terminée ==="
exit 0
