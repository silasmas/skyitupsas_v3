#!/usr/bin/env bash
# Synchronise AdminPanelProvider (signature Sdev) et recharge les caches Laravel.
set -uo pipefail

ADMIN="${ADMIN_DIR:-/home/u514199474/domains/skyitupsas.org/public_html/admin}"
LOG="${ADMIN_SYNC_LOG:-/home/u514199474/domains/skyitupsas.org/admin-sync.log}"
REPO_RAW="https://raw.githubusercontent.com/silasmas/skyitupsas_v3/main"

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

log "Mise à jour AdminPanelProvider.php..."
curl -fsSL -o app/Providers/Filament/AdminPanelProvider.php \
  "$REPO_RAW/app/Providers/Filament/AdminPanelProvider.php"

log "Rechargement des caches..."
"$PHP_BIN" artisan optimize:clear >> "$LOG" 2>&1 || true
"$PHP_BIN" artisan optimize >> "$LOG" 2>&1 || true

log "=== Signature admin synchronisée ==="
exit 0
