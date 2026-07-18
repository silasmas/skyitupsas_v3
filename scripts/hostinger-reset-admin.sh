#!/usr/bin/env bash
# Réinitialise le compte admin en base et synchronise AdminPanelProvider (logo login).
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

log "Mise à jour User.php (fillable classique)..."
curl -fsSL -o app/Models/User.php \
  "$REPO_RAW/app/Models/User.php"

log "Mise à jour AdminPanelProvider.php (logo login)..."
curl -fsSL -o app/Providers/Filament/AdminPanelProvider.php \
  "$REPO_RAW/app/Providers/Filament/AdminPanelProvider.php"

log "Mise à jour ResetAdminUserCommand.php..."
mkdir -p app/Console/Commands
curl -fsSL -o app/Console/Commands/ResetAdminUserCommand.php \
  "$REPO_RAW/app/Console/Commands/ResetAdminUserCommand.php"

log "Réinitialisation du compte admin ${ADMIN_EMAIL}..."
export ADMIN_PASSWORD="${ADMIN_PASS}"
"$PHP_BIN" artisan app:reset-admin \
  --email="${ADMIN_EMAIL}" \
  --password="${ADMIN_PASS}" \
  --force >> "$LOG" 2>&1 || {
  log "ÉCHEC app:reset-admin — voir le log."
  tail -n 30 "$LOG" | tee -a "$LOG"
  exit 1
}

log "Rechargement des caches..."
"$PHP_BIN" artisan optimize:clear >> "$LOG" 2>&1 || true
"$PHP_BIN" artisan optimize >> "$LOG" 2>&1 || true

log "=== Réinitialisation admin terminée ==="
exit 0
